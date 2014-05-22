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
                'actions' => array('create', 'add_image', 'delete', 'delete_image', 'add_coords', 'add_lure'),
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
        if ($model->save()) {
            $this->redirect(array('view', 'id' => $model->catch_id));
        }
        else
            echo 'perse';
        echo Yii::app()->user->getId();
        ;
    }

    /*
     * View spesific catch
     */

    public function actionView($id, $message = null) {
        $catch = Catches::model()->findByPk($id);

        /*
         * listData for lure dropdownlist
         */
        $lures = Lures::model()->findAll();
        $lure_data = CHtml::listData($lures, 'lure_id', 'model');

        if ($catch->lure_id != NULL) {
            $lure = Lures::model()->findByPk($catch->lure_id);
        } else {
            $lure = new Lures;
        }
        /*
         * listData for lake dropdownlist
         */
        $lakes = Lakes::model()->findAll(array('select' => 'concat(town, " ", lake_name) as data'));
        $lake_data = CHtml::listData($lakes, 'lake_id', 'data');

        if ($catch->lake_id != NULL) {
            $lake = Lakes::model()->findByPk($catch->lake_id);
        } else {
            $lake = new Lakes;
        }

        $this->render('view', array(
            'catch' => $catch,
            'lure' => $lure,
            'lake' => $lake,
            'lake_data' => $lake_data,
            'message' => $message,
        ));
    }

    /*
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
                $this->renderPartial('_lure_form', array('lure' => $lure, 'catch' => $catch));
            }
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
                $this->renderPartial('_lake_form', array('lake' => $lake, 'catch' => $catch));
            }
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
