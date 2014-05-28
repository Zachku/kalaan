<?php

class CatchesController extends Controller {

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'add_image', 'delete', 'delete_image', 'add_coords', 'add_lure', 'add_fish', 'add_date'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    /*
     * New Catch
     * 
     */

    public function actionCreate() {
        $model = new Catches;
        $model->date = date("Y-m-d H:i:s");
        if ($model->save()) {
            $this->redirect(array('view', 'id' => $model->catch_id));
        }
        echo Yii::app()->user->getId();
        ;
    }

    /*
     * View spesific catch
     */

    public function actionView($id, $message = null) {
        $catch = Catches::model()->findByPk($id);
        if ($catch->isOwner()) {
            if ($catch->lure_id != NULL) {
                $lure = Lures::model()->findByPk($catch->lure_id);
            } else {
                $lure = new Lures;
            }
            if ($catch->fish_id != NULL) {
                $fish = Fishes::model()->findByPk($catch->fish_id);
            } else {
                $fish = new Fishes;
            }
            
            $fishes_model = Fishes::model()->findAll();
            $fishes_list = CHtml::listData($fishes_model, 'fish_id', 'name');
            
            if ($catch->lake_id != NULL) {
                $lake = Lakes::model()->findByPk($catch->lake_id);
            } else {
                $lake = new Lakes;
            }
            $this->render('view', array(
                'catch' => $catch,
                'lure' => $lure,
                'fish' => $fish,
                'lake' => $lake,
                'message' => $message,
                'fishes_list' => $fishes_list,
            ));
        }
        else
            $this->redirect(array('catches/viewasaquest', 'id' => $id));
    }

    public function actionViewasaquest($id) {
        $catch = Catches::model()->findByPk($id);
        $lure = Lures::model()->findByPk($catch->lure_id);
        $fish = Fishes::model()->findByPk($catch->fish_id);
        $lake = Lakes::model()->findByPk($catch->lake_id);
        $owner = Users::model()->findByPk($catch->user_id);
        $this->render('viewasaquest', array(
            'catch' => $catch,
            'lure' => $lure,
            'fish' => $fish,
            'lake' => $lake,
            'owner' => $owner,
        ));
    }

    /* '
     * Delete catch
     */

    public function actionDelete() {

        $catch = Catches::model()->findByPk($_POST['catch_id']);
        if ($catch->user_id === Yii::app()->user->getId()) {
            $catch->delete();
            $this->redirect(array('users/my_profile'));
        }
    }

    /*
     * Add image of catch
     */

    public function actionAdd_image() {
        if (isset($_POST['Catches']['image']) && $_POST['Catches']['user_id'] == Yii::app()->user->getId()) {


            $catch = Catches::model()->findByPk($_POST['Catches']['catch_id']);
            $rnd = rand(1000000, 9999999);
            $image_url = $rnd . $catch->catch_id . '.png';
            $url = DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'catch_images' . DIRECTORY_SEPARATOR;
            $catch->image_url = $image_url;
            if ($catch->save()) {
                $uploadedFile = CUploadedFile::getInstance($catch, 'image');
                $uploadedFile->saveAs(Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . $url . $image_url);
                $image = Yii::app()->image->load(Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . $url . $image_url);
                $image->resize(400, 300);
                $image->save();
            }
            $this->redirect(array('view', 'id' => $catch->catch_id));
        }
    }

    public function actionDelete_image() {
        $catch = Catches::model()->findByPk($_POST['catch_id']);
        if ($catch->user_id === Yii::app()->user->getId()) {
            $url = DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'catch_images' . DIRECTORY_SEPARATOR;
            unlink(Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . $url . $catch->image_url);
            $catch->image_url = NULL;
            $catch->save();
            $this->redirect(array('view', 'id' => $catch->catch_id));
        }
    }

    public function actionAdd_coords($id) {
        $catch = Catches::model()->findByPk($id);
        if ($catch->isOwner()) {
            if (isset($_POST['lng']) && isset($_POST['lat'])) {
                $catch->coord_longitude = $_POST['lng'];
                $catch->coord_latitude = $_POST['lat'];
                $catch->save();
            }
        } else {
            throw new CHttpException(401, 'You are doing something you should not.');
        }
    }

    /**
     * Create or update lure
     */
    public function actionAdd_lure($id) {
        $catch = Catches::model()->findByPk($id);
        $lure = ($catch->lure_id ? Lures::model()->findByPk($catch->lure_id) : new Lures());
        if ($catch->isOwner() && isset($_POST['Lures'])) {
            $lure->attributes = $_POST['Lures'];
            if ($lure->save()) {
                $catch->lure_id = $lure->lure_id;
                $catch->save();
                $this->renderPartial('_lure_form', array('lure' => $lure, 'catch' => $catch, 'lureMessage' => 'Success'));
            }
            else
                $this->renderPartial('_lure_form', array('lure' => $lure, 'catch' => $catch, 'lureMessage' => 'Something went wrong'));
        }
        Yii::app()->end();
    }

    /**
     * Create or update lure
     */
    public function actionAdd_lake($id) {
        $catch = Catches::model()->findByPk($id);
        $lake = ($catch->lake_id ? Lakes::model()->findByPk($catch->lake_id) : new Lakes());
        if ($catch->isOwner() && isset($_POST['Lakes'])) {
            $lake->attributes = $_POST['Lakes'];
            if ($lake->save()) {
                $catch->lake_id = $lake->lake_id;
                $catch->save();
                $this->renderPartial('_lake_form', array('lake' => $lake, 'catch' => $catch, 'lakeMessage' => 'Success'));
            } else {
                $this->renderPartial('_lake_form', array('lake' => $lake, 'catch' => $catch, 'lakeMessage' => 'Something went wrong'));
            }
        }
    }

    /**
     * Create or update fish
     */
    public function actionAdd_fish($id) {
        $catch = Catches::model()->findByPk($id);
        $fish = Fishes::model()->findByPk($_POST['Fishes']['fish_id']);
        if ($catch->isOwner() && isset($_POST['Fishes'])) {
            if(isset($_POST['Catches']['weight'])){
                $catch->weight = $_POST['Catches']['weight'];
            }
            $fishes_model = Fishes::model()->findAll();
            $fishes_list = CHtml::listData($fishes_model, 'fish_id', 'name');
            
            $catch->fish_id =  $_POST['Fishes']['fish_id'];
            if ($catch->save()) {
                $this->renderPartial('_fish_form', array('fish' => $fish, 'catch' => $catch, 'fishes_list' => $fishes_list, 'fishMessage' => 'Success'));              
            } else {
                $this->renderPartial('_fish_form', array('fish' => $fish, 'catch' => $catch, 'fishes_list' => $fishes_list,'fishMessage' => 'There is something missing.'));
            }
        }
    }

    /**
     * Add or change date
     */
    public function actionAdd_date($id) {
        $catch = Catches::model()->findByPk($id);
        if ($catch->isOwner()) {
            $catch->date = $_POST['catch_date'];
            $catch->save();
            $this->renderPartial('_date', array('catch' => $catch), false, true);
            Yii::app()->end();
        }
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
