# Installation
* #### Download Mongodb & Install
  [Download link](https://www.mongodb.com/download-center#community)
  
* #### Install Mongodb Driver & Package on windows & Configuration
  * [Download Mongodb Driver link](http://php.net/manual/en/mongodb.installation.windows.php) 
  * [Download Mongodb Package link](http://pecl.php.net/package/mongodb) - download package based on your operating system `example: PHP 7.1 Thread Safe (TS) x86`.
    * After download package past it to `Your xampp\php\ext`
  * Add the following line to your `php.ini` file  `extension=php_mongodb.dll`
  * Create a folder `C:\data\db`
  * Go to `( Your-Monogodb-path\Server\3.4\bin )` Open cmd run `mongod` this command run the mongodb server.
  
# Mongodb Integrate with Laravel
* Install MongoDB Driver Library inside laravel `composer require mongodb/mongodb` done.

  #### CRUD Operation
   ```php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    use MongoDB\Client as Mongo;
    use MongoDB\BSON\ObjectId;

    class MongoController extends Controller
    {
      protected $db;

      public function __construct(){
        $this->db = (new Mongo)->dbtest;
      }

        public function index() {    	
          return view('welcome');
        }

        /**
         * Show Item lists
         * @return Collections
         */
        public function itemList() {
          $userCollection = $this->db->users;
          return $userCollection->find([], ['sort' => ['sex' => 1]])->toArray();
        }

        /**
         * Store Item
         * @param  Request $request 
         * @return String           
         */
        public function store(Request $request) {
          $tbl = $this->db->users;
          $store = $tbl->insertOne([
            'name' => $request->name,
            'age' => $request->age,
            'sex' => $request->sex,
            'skills' => implode(',', $request->skills),
            'email' => $request->email,
            'password' => bcrypt($request->password),
          ]);
          return printf("%s Last Insert Id & %s Row Created", $store->getInsertedId(), $store->getInsertedCount());
        }

        /**
         * Update Operation
         * @param  $id      
         * @param  Request $request 
         * @return String       
         */
        public function update($id, Request $request) {
          $data = [
            'name' => $request->name,
            'age' => $request->age,
            'sex' => $request->sex,
            'skills' => implode(',', $request->skills),
            'email' => $request->email,
          ];
          $tbl = $this->db->users;
          $update = $tbl->updateOne(
              ['_id' => new ObjectId($id)],
              ['$set' => $data]
          );
          return printf("Modified  %d document(s)\n", $update->getMatchedCount());
        }

        /**
         * Delete Item
         * @param  $id 
         * @return String     
         */
        public function destroy($id) {
          $tbl = $this->db->users;
          $destroy = $tbl->deleteOne(['_id' => new ObjectId($id)]);
          //$destroy->deleteMany(['state' => 'ny']);
          return printf("Deleted %d document(s)\n", $destroy->getDeletedCount());
        }
    }

   ```
    * #### Install Third party package inside laravel it's provide Eloquent Service
      * [laravel-mongodb](https://github.com/jenssegers/laravel-mongodb)
