<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Damage;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionList()
    { 
        $query_damage_data = Damage::find()->where(['is_delete'=>false]);
        
        return $this->render('list', [
            'damage_data_provider' => new ActiveDataProvider([
                'query' => $query_damage_data
            ])
        ]);
    }
    
    public function actionCreateDamage()
    {
        $message = "";       
        $manage_damage_data_dto = Damage::getReferenceDataForLists();
        $manage_damage_data_dto->damage_model = new Damage();
        
        if (Yii::$app->request->post()) {  
            
            $manage_damage_data_dto->damage_model->load(Yii::$app->request->post());
            
            if ($manage_damage_data_dto->damage_model->validate()) {   

                $manage_damage_data_dto->damage_model->emergence_time = date('Y-m-d H:i:s');
                $manage_damage_data_dto->damage_model->is_delete = false;
                $result = $manage_damage_data_dto->damage_model->save();
                        
                if ($result) {
                    return Yii::$app->response->redirect("/list"); 
                } else {
                    $message = "Ошибка при сохранении новой записи";
                }               
            } else {
                $message = "Ошибка при валидации полученных данных";
            }      
        }
        
        return $this->render('create', [
            'manage_damage_data_dto' => $manage_damage_data_dto,
            'message' => $message
        ]);
    }
    
    public function actionUpdateDamage(string $update_id)
    {       
        $message = "";      
        $manage_damage_data_dto = Damage::getReferenceDataForLists();
        $manage_damage_data_dto->damage_model = Damage::findOne($update_id);

        if (Yii::$app->request->post()) {    

            $manage_damage_data_dto->damage_model->load(Yii::$app->request->post());
            
            if ($manage_damage_data_dto->damage_model->validate()) {                               
                
                $result = $manage_damage_data_dto->damage_model->save();

                if ($result) {
                    return Yii::$app->response->redirect("/list"); 
                } else {
                    $message = "Ошибка при сохранении изменений";
                }               
            } else {                
                $message = "Ошибка при валидации данных для изменения";
            }      
        }               
        
        return $this->render('update', [
            'manage_damage_data_dto' => $manage_damage_data_dto,
            'message' => $message
        ]);
    }
    
    public function actionDeleteDamage(string $delete_id)
    {
        $delete_damage_record = Damage::findOne($delete_id);
        $delete_damage_record->is_delete = true;
        $delete_damage_record->save();        
        return Yii::$app->response->redirect("/list"); 
    }
}
