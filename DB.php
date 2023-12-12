<?php
class DB{
    private $baseURL;
    private $pdo;

    public function __construct(){
        $this->baseURL=$baseURL;
        $this->pdo = new PDO("mysql:host=localhost;dbname=inmange", "root", "");  
    }

    public function setup() {

        // יצירת טבלה
        $createUsersTable = "CREATE TABLE IF NOT EXISTS Users (
            id INT PRIMARY KEY,
            name VARCHAR(255),
            email VARCHAR(255),
            active BOOLEAN
         )";
         $this->$pdo->exec($createUsersTable);
         echo 'USERS created seccessfully';


        //  יצירת טבלת פוסטים
         $createPostsTable = "CREATE TABLE IF NOT EXISTS Posts (
            id INT PRIMARY KEY,
            user_id INT,
            title VARCHAR(255),
            content TEXT,
            creation_date DATE,
            active BOOLEAN,
            FOREIGN KEY (user_id) REFERENCES Users(id)
        )";
        echo 'posts created seccessfully';
 
    }

   

    public get_users_with_post() {
        return $this->select("SELECT * FROM users Where active = true join on posts p p.user_id == id")
    }

    private function makeRequest($method,$url,$data=array()){
        $ch=curl_init()

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_URL,$url,$method);
        curl_setopt($ch,CURLOPT_URL,$url,true);

        if(method==="POST"||$method==='PUT'){
            $data=json_encode($data);
            curl_setopt($ch,CURLOPT_URL,$data);
            curl_setopt($ch,CURLOPT_URL,array('Content-Type:application/json'))
        }
        $response=curl_exec($ch)
        curl_close($ch)

        return json_decode($response,true)


    }


}

// יצירת אוביקט

$db=new DB('https://jsonplaceholder.typicode.com')

// ביצוע שאילת
$selectResult=$db->select('posts',array('userId'=>1));
print_r($selectResult)

$insertDate=array(
    'title'=> 'food',
    'body'=> 'bar'
    'userId'=>1
);

$insertResult=$db->insert('posts',$insertDate)
print_r($insertResult)

$updateData=array(
    'title'=>'food-update'
    'body'=>'food-update'
)
$updateResult=db->update('posts',1,$updateData)
print_r($updateResult)

$deleteResult=$db->delete('posts',1)
print_r($deleteResult)
