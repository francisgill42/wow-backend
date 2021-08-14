<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

            // $arr = [
            //     'Montessori',
            //     'Nursery',
            //     'KG 1',
            //     'KG 2',
            //     'Class 1',
            //     'Class 2',
            //     'Class 3',
            //     'Class 4',
            //     'Class 5',
            //     'Class 6',
            //     'Class 7',
            //     'Class 8',
            //     'Class 9',
            //     'Class 10',
            // ];
    
            // foreach($arr as $a){
            //     App\Level::create(['level' => $a]);
            // }

            // $arr = [
            //     'English',
            //     'Urdu',
            //     'Math'
            // ];
            // for ($i=1; $i <= 14 ; $i++) {
    
            // foreach($arr as $a){
     
            //         App\Subject::create(['subject' => $a,'level_id' => $i]);
            //     }
    
            // }

            $user = \App\User::create([
                'name' => 'master',
                'email' => 'master@erp.com',
                'password' => bcrypt('secret'),
            ]);
         
        }

       

        
    
}
