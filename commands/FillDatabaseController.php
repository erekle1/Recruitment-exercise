<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\activeRecord\User;
use app\models\Loan;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FillDatabaseController extends Controller
{

    public function actionIndex()
    {
        $loansJson = json_decode(file_get_contents(@web . '/json/loans.json'), true);
        $usersJson = json_decode(file_get_contents(@web . '/json/users.json'), true);

        foreach ($usersJson as $item) {
            if (is_null(User::findOne($item['id']))) {
                $user                = new User();
                $user->id            = $item['id'];
                $user->first_name    = $item['first_name'];
                $user->last_name     = $item['last_name'];
                $user->email         = $item['email'];
                $user->personal_code = $item['personal_code'];
                $user->phone         = $item['phone'];
                $user->lang          = $item['lang'];
                $user->active        = $item['active'] == "0" ? false : true;
                $user->dead          = $item['dead'] == "0" ? false : true;
                $user->save(true);
            }
        }

        foreach ($loansJson as $item) {
            if (is_null(Loan::findOne($item['id']))) {
                $loan             = new Loan();
                $loan->user_id    = $item['user_id'];
                $loan->amount     = $item['amount'];
                $loan->interest   = $item['interest'];
                $loan->duration   = $item['duration'];
                $loan->start_date = gmdate('Y-m-d', $item['start_date']);
                $loan->end_date   = gmdate('Y-m-d', $item['end_date']);
                $loan->campaign   = $item['campaign'];
                $loan->status     = $item['status'] == "1" ? true : false;
                $loan->load($item);
                $loan->save();
            }
        }
    }

}
