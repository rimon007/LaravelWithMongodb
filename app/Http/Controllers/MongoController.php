<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use MongoDB\Client as Mongo;
use MongoDB\BSON\ObjectId;

class MongoController extends Controller
{
	protected $db;

	public function __construct(){
		$this->db = (new Mongo)->dbquitch;
	}

    public function index() {    	
		//$collection = (new Mongo)->dbquitch->userCollection;
		// $collection = \Mongo::get()->dbquitch->userCollection;
	 //    return $collection->find([], [
	 //    				"sort" => ['created_at' => -1], 
	 //    				"limit" => 2,
	 //    				"skip" => 1
	 //    			])->toArray();
	 	return view('welcome');
    }

    public function itemList() {
    	$userCollection = $this->db->users;
    	return $userCollection->find([], ['sort' => ['sex' => 1]])->toArray();
    }

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

    public function destroy($id) {
    	$tbl = $this->db->users;
    	$destroy = $tbl->deleteOne(['_id' => new ObjectId($id)]);
    	//$destroy->deleteMany(['state' => 'ny']);
    	return printf("Deleted %d document(s)\n", $destroy->getDeletedCount());
    }
}
