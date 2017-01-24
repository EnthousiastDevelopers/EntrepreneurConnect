<?php
require('session.php');

if(isset( $_GET["id"])){
	  $id = $_GET["id"];
}else {
	  $id = $_SESSION["userID"];
}
?>
<html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.24/angular.min.js"></script>
    <script src="https://angular-file-upload.appspot.com/js/ng-file-upload.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-sanitize.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular-filter/0.4.7/angular-filter.js"></script>
	  <script src="https://code.angularjs.org/1.2.20/angular-route.min.js"></script>
<script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.min.js"></script>

    <script>
        var id = '<?php echo $id?>';
        var myid = '<?php echo $_SESSION["userID"];?>';
    </script>
</head>

<body ng-app="fetch_bio" ng-controller="dbCtrl">
  <div>
            <p ng-bind-html="error_logs"></p>
        </div>
<div id="menu">
<h1>Menu</h1>
<ul>
<li><a href="#SearchYourBestFit" ng-click="ToggleMode('Search');">Search</a></li>
<li><a href="#ExploreEveryOneYouCan" ng-click="ToggleMode('Explore');getDataPeople();">Explore</a></li>
<li><a href="{{MyProfileUrl}}" ng-click="ToggleMode('MyProfile');">My Profile</a></li>
<li><a href="#myAwsomeAccount" ng-click="ToggleMode('MyAccount'); get_myDataUser();">My Account</a></li>
</ul>
</div>

    <div id="preference" >
	<h1>What are you looking for?</h1>
	<span ng-hide="false">
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1"  onClick='some_function()'/>
	<label>I want to know myself and get business ideas</label></span>
	<br>
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1"  onClick='some_function()'/>
	<label>I want to build a team for my business</label>
	<br>
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1"  onClick='some_function()'/>
	<label>I Just want to explore people</label>
	<br>
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1"  onClick='some_function()'/>
	<label>All</label>
	<br>
<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="button" value="GET STARTED" name = "name 1"  onClick=''/>
	</div>
	<div id="search" >
	<h1>Search</h1>
	<h2>Search people by personality</h2>
	<table  class="table table-hover">
	<tr><th>Criteria</th><th></th><th>Keyword</th><th></th><th>Search</th></tr>
	
	<tr ng-repeat="item in bio"><td>{{item.Title}}</td><td>
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1"  onClick='some_function()'/></td><td><input id = "id 1" class="class 1" placeholder="your placeholder 1" type="input 1" value="" name = "name 1"  onClick=''/></td><td><input type="button" value="Add" onClick=''/></td><td></td></tr>
	</table>
	<h2>Search people by ratings</h2>
	<table  class="table table-hover">
	<tr><th>Criteria</th><th></th><th>Keyword</th><th></th><th>Search</th></tr>
	
	<tr ng-repeat="item in ratings"><td>{{item.Title}}</td><td>
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1"  onClick='some_function()'/></td><td><input id = "id 1" class="class 1" placeholder="your placeholder 1" type="input 1" value="" name = "name 1"  onClick=''/></td><td><input type="button" value="Add" onClick=''/></td><td></td></tr>
	</table>
	<input width="600" type = "button" value="Search"/>
	
	
	</div>
    
	
	<div id="explore" ng-if="Mode=='Explore'">
	<h1>Explore</h1>
	Rank
	<div ng-repeat="person in  data_people | orderBy : '-Rate'">
	<a href="profile.php?id={{person.ID}}">
	<h2>{{$index+1}} - {{person.FirstName}} {{person.LastName}}<span ng-if="person.ID == myid">(you)</span></h2>
	
		
		
	  <img src="{{person.PictureUrl || 'uploads/basic-profile.png'}}" alt="image"  height="100" align="left"  />
		  {{person.status}}
		  <h3>
		 <span ng-if="person.Rate!=0">{{person.Rate}} out of 5</span><br>
		 <span ng-if="person.Rate==0"> Be the first to rate this person</span><br>
			</h3>
		  	{{person.ReviewCount}} Review(s). 
	  </a>
	  	<br>
	<br>
	<br>
	<br>
	</div>

    </div>
	
	<div id="MyAccount" ng-if="Mode=='MyAccount'">
	<h1>My Account</h1>
            <div ng-repeat="info in my_data_user">
	<h3>Name: {{info.FirstName}} {{info.LastName}}</h3>
	<h3>Username: {{info.Username}}</h3>
	<h3>Email: {{info.Email}}</h3>
	<h3>Password: {{info.Password}}</h3>
	<h3>Member since: {{info.Creation}}</h3>
	<a href="logout.php">Logout</a>
    </div>
    </div>
	<div id="profile" ng-show="Mode=='MyProfile'">
      
        <div id="container" class="" style="">
            <div ng-repeat="name in data_user">
                <h1>{{name.FirstName}} {{name.LastName}}</h1>
            </div>
            <img src="{{pictureUrl || 'uploads/basic-profile.png'}}" alt="image" align="left" height="100" />
            <span ng-show="PictureOn">
			<input type="file" ngf-select="onFileSelect($file)" ngf-pattern="'image/*'"/>
			<input type="button" value="Save" ng-click="PictureOnMode();savePicture()"/>
			<input type="button" value="Cancel" ng-click="PictureOnMode(); pictureUrl = pictureUrlTemp "/>
			</span>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <a href="#verycomplicatedwebsitewithnicedesign" ng-if="ModeEdit" ng-click="PictureOnMode()">Edit Profile picture</a>


        </div>

    <h2>Status</h2>
    <h4 ng-repeat="value in filtered =( data_bio | filter:{Title:'status'}) " ng-mouseover="hoverIn(value.sho)" ng-mouseleave="hoverOut()"><span ng-hide="value.txtsho">{{value.Value}}   </span>
        <input ng-show="value.sho == 1" ng-model="value.Value" ng-blur="doneEditing(item)" autofocus="true" />
        <span ng-show="hoverEdit" ng-if="ModeEdit">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="editItem(value)">Edit</a>&nbsp<a href="#verycomplicatedwebsitewithnicedesign" ng-click="deleteItem(value)">Remove</a></span><span ng-show="value.sho == 1"><button ng-click="doneEditing(value)">Save</button><button ng-click="cancelEditing(value)">Cancel</button> </span>
    </h4>


    <h4 ng-if="ModeEdit" ng-repeat="item in titles  | filter:{title:'status'}">
        <input ng-show="item.tryaddsho" ng-model="item.newItemValue" autofocus="true" />
        <span ng-show="!item.tryaddsho">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-if="filtered.length != 1" ng-click="tryAddItem(item)">Add new {{item.title}}</a>
            </span>
        <span ng-show="item.tryaddsho">
            <button ng-click="addItem(item)">Save</button>
            <button ng-click="cancelEditing(item)">Cancel</button> </span>
    </h4>


    <h2>Public Rating</h2>
	<input ng-if="!ModeEdit" ng-hide="RatePersonBool()"  id = "id 1" class="class 1" placeholder="your placeholder 1" type="button" value="Rate this person" name = "name 1" ng-click="rateEditOn()" />

    <div id="Ratings">
	
        <div ng-show="RateEditMode"  id="Ratings-Edit">
            <h3>My Rating</h3>
		            <div class="row">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Label</th>
                                <th>Rate</th>
                                <th></th>
                                <th>Comment (optional)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="rating in ratings | filter:searchFilter">
                                <td>{{rating.Title}}</td>
                                <td>
1 <input id = "rating-1"   class="rating-1" placeholder="" type="radio" value="1" ng-model="rating.Value" name = "{{rating.Title}}"  onClick=''/>
  <input id = "rating-1" class="rating-1" placeholder="" type="radio" ng-model="rating.Value" value="2" name = "{{rating.Title}}"  onClick=''/>
  <input id = "rating-1" class="rating-1" placeholder="" type="radio" ng-model="rating.Value" value="3" name = "{{rating.Title}}"  onClick=''/>
  <input id = "rating-1" class="rating-1" placeholder="" ng-checked="true" type="radio" ng-model="rating.Value" value="4" name = "{{rating.Title}}"  onClick=''/>
  <input id = "rating-1" class="rating-1" placeholder="" type="radio" ng-model="rating.Value"  value="5" name = "{{rating.Title}}"  onClick=''/> 5</td>
                                <td>{{rating.Value}}</td>
                                <td><input type="text"/></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
				<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="button" value="Submit My Ratings" ng-hide="IalreadyRated" name = "name 1"  ng-click='submitRating()'/> 
				<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="button" value="Save Edits" ng-show="IalreadyRated"  name = "name 1"  ng-click='ConfirmEditRating()' " /> 
				<input  id = "id 1" class="class 1" placeholder="your placeholder 1" type="button" value="Cancel" name = "name 1"  ng-click=' cancelEditRatings();;'/>
            </div>
			
			
	
		</div>
        <div id="Ratings-View">
            <h3>Overall Ratings: {{ getTotal() }} out of {{getNumberOfRate()}} Review(s)</h3> 
            <div class="row">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Label</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(key, value) in data | groupBy: 'Title'">
                                <td>{{key}}</td>
                                <td>{{getAvg(value)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div ng-if="IalreadyRated">
			<input  id = "id 1" class="class 1" placeholder="your placeholder 1" type="button" value="Edit My Ratings" name = "name 1"  ng-click='rateEditOn(); EditMyRatings();'/>
			
            </div>
        </div>
    </div>
    <h2>My Passions - Cause - Interests</h2>
    <ul>

        <li ng-repeat="value in filtered.core = (data_bio | filter:{Title:'core'})" ng-mouseover="hoverIn(value.sho)" ng-mouseleave="hoverOut()"><span ng-hide="value.txtsho">{{value.Value}}   </span>
            <input ng-show="value.sho == 1" ng-model="value.Value" ng-blur="doneEditing(item)" autofocus="true" />
            <span ng-show="hoverEdit" ng-if="ModeEdit">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="editItem(value)">Edit</a>&nbsp<a href="#verycomplicatedwebsitewithnicedesign" ng-click="deleteItem(value)">Remove</a></span><span ng-show="value.sho == 1"><button ng-click="doneEditing(value)">Save</button><button ng-click="cancelEditing(value)">Cancel</button> </span>
        </li>

        <li ng-if="ModeEdit" ng-repeat="item in titles  | filter:{title:'core'}">
            <input ng-show="item.tryaddsho" ng-model="item.newItemValue" autofocus="true" />
            <span ng-show="!item.tryaddsho">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="tryAddItem(item)">Add new {{item.title}}</a>
            </span>
            <span ng-show="item.tryaddsho">
            <button ng-click="addItem(item)">Save</button>
            <button ng-click="cancelEditing(item)">Cancel</button> </span>
        </li>
						<span ng-if="filtered.core.length==0 && !ModeEdit">No Data</span>

    </ul>
    <h2> Goals - Dreams - Ambitions - Vision</h2>
    <ul>

        <li ng-repeat="value in filtered.vision = (data_bio | filter:{Title:'vision'})" ng-mouseover="hoverIn(value.sho)" ng-mouseleave="hoverOut()"><span ng-hide="value.txtsho">{{value.Value}}   </span>
            <input ng-show="value.sho == 1" ng-model="value.Value" ng-blur="doneEditing(item)" autofocus="true" />
            <span ng-show="hoverEdit" ng-if="ModeEdit">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="editItem(value)">Edit</a>&nbsp<a href="#verycomplicatedwebsitewithnicedesign" ng-click="deleteItem(value)">Remove</a></span><span ng-show="value.sho == 1"><button ng-click="doneEditing(value)">Save</button><button ng-click="cancelEditing(value)">Cancel</button> </span>
        </li>

        <li ng-if="ModeEdit" ng-repeat="item in titles  | filter:{title:'vision'}">
            <input ng-show="item.tryaddsho" ng-model="item.newItemValue" autofocus="true" />
            <span ng-show="!item.tryaddsho">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="tryAddItem(item)">Add new {{item.title}}</a>
            </span>
            <span ng-show="item.tryaddsho">
            <button ng-click="addItem(item)">Save</button>
            <button ng-click="cancelEditing(item)">Cancel</button> </span>
        </li>
				<span ng-if="filtered.vision.length==0 && !ModeEdit">No Data</span>

    </ul>
    <h2>What I Have</h2>
    <ul>
        <li ng-repeat="value in filtered.product = (data_bio | filter:{Title:'product'})" ng-mouseover="hoverIn(value.sho)" ng-mouseleave="hoverOut()"><span ng-hide="value.txtsho">{{value.Value}}   </span>
            <input ng-show="value.sho == 1" ng-model="value.Value" ng-blur="doneEditing(item)" autofocus="true" />
            <span ng-show="hoverEdit" ng-if="ModeEdit">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="editItem(value)">Edit</a>&nbsp<a href="#verycomplicatedwebsitewithnicedesign" ng-click="deleteItem(value)">Remove</a></span><span ng-show="value.sho == 1"><button ng-click="doneEditing(value)">Save</button><button ng-click="cancelEditing(value)">Cancel</button> </span>
        </li>

        <li ng-if="ModeEdit" ng-repeat="item in titles  | filter:{title:'product'}">
            <input ng-show="item.tryaddsho" ng-model="item.newItemValue" autofocus="true" />
            <span ng-show="!item.tryaddsho">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="tryAddItem(item)">Add new {{item.title}}</a>
            </span>
            <span ng-show="item.tryaddsho">
            <button ng-click="addItem(item)">Save</button>
            <button ng-click="cancelEditing(item)">Cancel</button> </span>
        </li>
		<span ng-if="filtered.product.length==0 && !ModeEdit">No Data</span>

    </ul>
    <h2>My service</h2>
    <ul>
        <li ng-repeat="value in filtered.service = (data_bio | filter:{Title:'service'})" ng-mouseover="hoverIn(value.sho)" ng-mouseleave="hoverOut()"><span ng-hide="value.txtsho">{{value.Value}}   </span>
            <input ng-show="value.sho == 1" ng-model="value.Value" ng-blur="doneEditing(item)" autofocus="true" />
            <span ng-show="hoverEdit" ng-if="ModeEdit">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="editItem(value)">Edit</a>&nbsp<a href="#verycomplicatedwebsitewithnicedesign" ng-click="deleteItem(value)">Remove</a></span><span ng-show="value.sho == 1"><button ng-click="doneEditing(value)">Save</button><button ng-click="cancelEditing(value)">Cancel</button> </span>
        </li>
        <li ng-if="ModeEdit" ng-repeat="item in titles  | filter:{title:'service'}">
            <input ng-show="item.tryaddsho" ng-model="item.newItemValue" autofocus="true" />
            <span ng-show="!item.tryaddsho">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="tryAddItem(item)">Add new {{item.title}}</a>
            </span>
            <span ng-show="item.tryaddsho">
            <button ng-click="addItem(item)">Save</button>
            <button ng-click="cancelEditing(item)">Cancel</button> </span>
        </li>
				<span ng-if="filtered.service.length==0 && !ModeEdit">No Data</span>

    </ul>
    <h2>My skills</h2>
    <ul>
        <li ng-repeat="value in filtered.skills = ( data_bio | filter:{Title:'skills'})" ng-mouseover="hoverIn(value.sho)" ng-mouseleave="hoverOut()"><span ng-hide="value.txtsho">{{value.Value}}   </span>
            <input ng-show="value.sho == 1" ng-model="value.Value" ng-blur="doneEditing(item)" autofocus="true" />
            <span ng-show="hoverEdit" ng-if="ModeEdit">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="editItem(value)">Edit</a>&nbsp<a href="#verycomplicatedwebsitewithnicedesign" ng-click="deleteItem(value)">Remove</a></span><span ng-show="value.sho == 1"><button ng-click="doneEditing(value)">Save</button><button ng-click="cancelEditing(value)">Cancel</button> </span
        ></li>
        <li ng-if="ModeEdit" ng-repeat="item in titles  | filter:{title:'skills'}">
            <input ng-show="item.tryaddsho" ng-model="item.newItemValue" autofocus="true" />
            <span ng-show="!item.tryaddsho">
            <a href="#verycomplicatedwebsitewithnicedesign" ng-click="tryAddItem(item)">Add new {{item.title}}</a>
            </span>
            <span ng-show="item.tryaddsho">
            <button ng-click="addItem(item)">Save</button>
            <button ng-click="cancelEditing(item)">Cancel</button> </span>
        </li>
		<span ng-if="filtered.skills.length==0 && !ModeEdit">No Data</span>
    </ul>
	    </div>
</body>
<script>
//VARIABLE GLOSSARY
//data_people: all users, used in explore mode
//data_bio: the current opened profile all detailed information
//data: the current opened profile all ratings information
//data_user: the current opened profile all basic information
//myid: the logged user ID
//id: the current opened profile id
//$scope.ratings : initialised array of ratings, but become ratings of the logged user on the opened profile if edit my ratings is clicked

    var fetch_bio = angular.module('fetch_bio', ['ngRoute','angular.filter','ngFileUpload', 'ngSanitize']);

    fetch_bio.controller('dbCtrl', ['$scope', '$http', 'Upload','$route', function($scope, $http, Upload, $route) {


///<----EXPLORE--->///
	$scope.getDataPeople = function (){
				
		  $http.get('get.php?q=explore&id=idsOnScreen')
            .success(function(data) {
                $scope.data_people = data;
                console.log('data_people');
                console.log(data);
               // $scope.error_logs = data;
                // alert('pictureID is: '+ pictureID);
					if(typeof($scope.data_explore_bio)=='undefined'){
						get_data_explore_bio();
					}else{
					
					lookup_explore_pictureURL();
					lookup_explore_reviews();
				}//else
            })//</success get>
            .error(function() {
                $scope.data_people = "error in fetching data";
            });
				
			}


			
			
	function get_data_explore_ratings(){
							
			$scope.titles_list = _.uniq(_.map($scope.data_explore_bio, 'Parent')); 
			  
			  $scope.modifiedData = [];
			   angular.forEach($scope.titles_list, function (parent){
				 var eachCategory_temp = _.filter($scope.data_explore_bio, {'Parent': parent});
				 eachCategory = _.filter(eachCategory_temp, {'Category': 'ratings'});
				 
				 console.log('eachCategory');
				 console.log(eachCategory);
				 var sum = 0;
				 _.map(eachCategory, function (each){ //iterate other filtered category
				   sum += parseInt(each.Value); //incrementing the sum of this category
				 }); //end of iteration
				 var ReviewCount = _.uniq(_.map(eachCategory, 'Author')).length; 
				 if(!$scope.modifiedData[parent]){
					 var Rate =  +(sum/eachCategory.length).toFixed(2);
					
					if(isNaN(Rate)){
						 Rate = 0;
					 }
				  $scope.modifiedData.push({'Parent': parent, 'Value':Rate, 'ReviewCount':ReviewCount});
				   }
			   });
				 console.log('modifiedData');
			   console.log($scope.modifiedData );
			   lookup_explore_reviews();
			   
			}
			
			
			function lookup_explore_reviews(){
				var filtered = [];
                angular.forEach($scope.data_people, function(item, key) { //lookup average ratings, reviewcount from id in data_people to Parent in modifiedData
					
					var pos = $scope.modifiedData.map(function(e) { return e.Parent; }).indexOf(item.ID);//position in modifiedData where Parent equals item.ID (or $scope.data_people.ID)
					//alert(pos);
					if(pos >= 0) {
						$scope.data_people[key].ReviewCount = $scope.modifiedData[pos].ReviewCount;
						
						$scope.data_people[key].Rate = $scope.modifiedData[pos].Value;
					//alert($scope.modifiedData[pos].Value);
					}else{
				$scope.data_people[key].ReviewCount = 0;
						$scope.data_people[key].Rate = 0;
					}
					
                });//for each lookup
			}
			
			function lookup_explore_pictureURL(){
				var filtered = [];
                angular.forEach($scope.data_people, function(item, key) { //lookup profile picture from id in data_people to value in data_explore_bio
					
					var pos = $scope.data_explore_bio.map(function(e) { return e.ID; }).indexOf(item.PictureID);
					if(pos != 0) {
						$scope.data_people[key].PictureUrl = $scope.data_explore_bio[pos].Value;
					//alert($scope.data_explore_bio[pos].Value);
					}else{
						$scope.data_people[key].PictureUrl = 'uploads/basic-profile.png';
					}
					
                });//for each lookup
			};
//getdatapeople in EXPLORE > lookup profile pictures using data_people


			function get_data_explore_bio() {
				$http.get('get.php?q=explore_profile&c=bio&id=exploreids')
            .success(function(data) {
                $scope.data_explore_bio = data;
				//alert(data);
                console.log('data_explore_bio');
				console.log(data); 
                lookup_explore_pictureURL();
				get_data_explore_ratings();
            })
            .error(function() {
                $scope.data_explore_bio = "error in fetching data";
            });
			}
///<----/EXPLORE--->///

// alert(id);

//setting url for my profile on menu
$scope.Mode = 'MyProfile';
$scope.ModeEdit = 0;
$scope.IalreadyRated = false;

$scope.id = id;
$scope.myid = myid;
$scope.ConfirmEditRating = function () {
	 $scope.answerRatingsID = [];
	angular.forEach($scope.ratings, function(rating) {
		obj={};
		val={};
		val[rating.Title]=rating.Value;
		obj[rating.ID]=val;
      $scope.answerRatingsID.push(obj);
    });
	console.log('answerRatingsID');
	console.log($scope.answerRatingsID);
	   var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                }
            };
			
	 $http.post('post.php', {
                'message': $scope.answerRatingsID,
                'id': id,
                'authorID': myid,
                'action': 'EditMyRatings'
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {
					if(data == '1') {
						//$route.reload();
						location.reload();
						alert('done!');
					}else{
                 // $scope.error_logs = data;
					}
                  $scope.error_logs = data;
                    // alert(data);
					//reload the entire page
                } else {
                    $scope.errors.push(data.error);
                    throw new Error("my error message");
                    alert('an error has occured while contacting the server');
                }
            }).error(function(data, status) { // called asynchronously if an error occurs
                // or server returns response with an error status.
                throw new Error("my error message");
                alert('an error has occured while contacting the server');
                $scope.errors.push(status);
            });
    
}


$scope.EditMyRatings=function(){
	
var newdata = [];
    for( var i in $scope.data ){
	  if($scope.data[i].Author == myid) {
		  //alert($scope.data[i].Title);
      newdata.push(angular.copy($scope.data[i]));
     var pos = $scope.ratings.map(function(e) { return e.Title; }).indexOf($scope.data[i].Title);
	 //alert(pos);
	 $scope.ratings[pos] = angular.copy($scope.data[i]);
	 }
    }
	console.log($scope.ratings);
	// console.log(newdata);
	$scope.ratings_temp= angular.copy($scope.ratings);
	// $scope.ratings = newdata;
}
$scope.IalreadyRatedOff = function(){
	$scope.IalreadyRated = false;
};
$scope.IalreadyRatedOn = function(){
	$scope.IalreadyRated = true;
};
if(myid!=id){
	$scope.ModeEdit = 0;
	$scope.MyProfileUrl = 'profile.php';
}else {
	$scope.ModeEdit = 1;
	$scope.MyProfileUrl = '#MyAwesomeProfile';
}

$scope.ToggleMode = function (Mode){
$scope.Mode = Mode;
}

$scope.RatePersonBool = function() {
	if(!$scope.IalreadyRated &&  $scope.RateEditMode){
		//alert();
		return true;
	}else if($scope.IalreadyRated &&  !$scope.RateEditMode ) {
		//alert();
		return true;
	}else if($scope.IalreadyRated){
		return true;
	}else{
		//alert();
		return false;
	}
}

$scope.rateEditOn = function(){
	$scope.RateEditMode = true;
}
$scope.rateEditOff = function(){
	$scope.RateEditMode = false;
}
$scope.cancelEditRatings = function(){
	if( (typeof $scope.ratings_temp !== 'undefined')){
	for (i in $scope.ratings) {
		$scope.ratings[i] = $scope.ratings_temp[i];
	} 	
	}
	//$scope.ratings = angular.copy($scope.ratings_temp);
	$scope.rateEditOff();
//	$scope.IalreadyRatedOn();
}

  $scope.getAvg = function(values) {
      var sum = 0;
      for (var i=0;i<values.length;i++) {
        sum += parseInt(values[i].Value)
      }
      
      return (sum/values.length).toFixed(2);
    };
  
  
  //checkif I already rated just once
  function checkifIalreadyrated(){
	  
  var unique = {};
var distinct = [];
    for( var i in $scope.data ){
     if( typeof(unique[$scope.data[i].Author]) == "undefined"){
      distinct.push($scope.data[i].Author);
	  if($scope.data[i].Author == myid) {
		 // alert($scope.data[i].Author);
		 $scope.IalreadyRated = true;
	  }
     }
     unique[$scope.data[i].Author] = 0;
    }
	
  }
	//end of checkif I already rated just once
	
  
$scope.getNumberOfRate= function(){
	
var unique = {};
var distinct = [];
    for( var i in $scope.data ){
     if( typeof(unique[$scope.data[i].Author]) == "undefined"){
      distinct.push($scope.data[i].Author);
     }
     unique[$scope.data[i].Author] = 0;
    }
	return distinct.length;
}


$scope.submitRating = function(){
 $scope.answerRatingsID = [];
	angular.forEach($scope.ratings, function(rating) {
		obj={};
		obj[rating.Title]=rating.Value;
      $scope.answerRatingsID.push(obj);
    });
	   var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                }
            };
			
	 $http.post('post.php', {
                'message': $scope.answerRatingsID,
                'id': id,
                'authorID': myid,
                'action': 'AddRating'
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {
					if(data == '1') {
			 		location.reload();
						alert('done');
					//$window.location.reload();//reload the entire page
					}else{
                 // $scope.error_logs = data;
					}
                    // alert(data);
                } else {
                    $scope.errors.push(data.error);
                    throw new Error("my error message");
                    alert('an error has occured while contacting the server');
                }
            }).error(function(data, status) { // called asynchronously if an error occurs
                // or server returns response with an error status.
                throw new Error("my error message");
                alert('an error has occured while contacting the server');
                $scope.errors.push(status);
            });
        }
	



        $http.get('get.php?q=user&id='+id+'')
            .success(function(data) {
                $scope.data_user = data;
                console.log('data_user');
                console.log(data);
               // $scope.error_logs = data;
            //    alert($scope.data_user[0].PictureID);
            })
            .error(function() {
                $scope.data_user = "error in fetching data";
            });
			
			$scope.get_myDataUser = function (){
				if(typeof($scope.my_data_user)=='undefined') {
				$http.get('get.php?q=user&id='+myid+'')
					.success(function(data) {
						$scope.my_data_user = data;
						console.log('data_user');
						console.log(data);
					   // $scope.error_logs = data;
					   // alert($scope.data_user[0].PictureID);
					})
					.error(function() {
						$scope.my_data_user = "error in fetching data";
					});	
				}
			}				

        $http.get('get.php?q=profile&c=bio&id='+id+'')
            .success(function(data) {
                $scope.data_bio = data;
                console.log('data_bio'); 
                console.log(data); 
                //lookup profile picture url in data_bio, from pictureid in data_user
                //  alert($scope.data_user[0].PictureID);
                var pictureID = $scope.data_user[0].PictureID; //pictuerID from database
                //alert('pictureID is: '+ pictureID);
                var filtered = [];
                angular.forEach($scope.data_bio, function(item) {
                    if (item.ID == (pictureID)) {
						filtered.push(item);
						$scope.pictureUrlTemp = item.Value;
					}
                });
                $scope.pictureUrl = $scope.pictureUrlTemp;

                //alert($scope.pictureUrl);
                //end find profile picture

            })
            .error(function() {
                $scope.data_bio = "error in fetching data";
            });



        //upload file
        $scope.onFileSelect = function(file) {
            alert('file selected');
            if (!file) return;
            Upload.upload({
                url: 'post.php',
                data: {
                    file: file,
                    'id': id,
                    action: 'upload'
                }
            }).then(function(resp) {
                // file is uploaded successfully

                //$scope.error_logs = resp.data;
                console.log(resp.data);
                $scope.pictureUrl = resp.data[0].Value;
                $scope.newPictureID = resp.data[0].ID;
            });
        };



        $scope.PictureOnMode = function() {
            if ($scope.PictureOn) {
                $scope.PictureOn = false;
            } else {
                $scope.PictureOn = true;
            }
        }
        //end picture On
        $scope.titles = [{
                "id": 1,
                "title": "core",
            },
            {
                "id": 2,
                "title": "product",
            },
            {
                "id": 3,
                "title": "service",
            }, {
                "id": 4,
                "title": "skills",
            }, {
                "id": 5,
                "title": "status",
            }, {
                "id": 6,
                "title": "vision",
            }
        ];
  $scope.ratings = [{
                "id": 1,
                "Title": "Creativity",
                //"Answer": 3,
            },
            {
                "id": 2,
                "Title": "Courage",
            },
            {
                "id": 3,
                "Title": "Honnesty",
            }, {
                "id": 4,
                "Title": "Ambition",
            }, {
                "id": 5,
                "Title": "Integrity",
            }
        ];
		
  $scope.bio = [{
                "id": 1,
                "Title": "My Passions - Cause - Interests",
            },
            {
                "id": 2,
                "Title": "Goals - Dreams - Ambitions - Vision",
            },
            {
                "id": 3,
                "Title": "Services",
            }, {
                "id": 4,
                "Title": "Skills",
            }, {
                "id": 5,
                "Title": "Status",
            }, {
                "id": 6,
                "Title": "Product",
            }
        ];


        $http.get('get.php?q=profile&c=ratings&id='+id+'')
            .success(function(data) {
                $scope.data = data;
                checkifIalreadyrated();
               // $scope.error_logs= JSON.stringify(data);
				
            })
            .error(function() {
                $scope.data = "error in fetching data";
            });



        $scope.editItem = function(item) {
            item.sho = true;
            item.txtsho = true;
            item.Cancel = item.Value;
        }

        $scope.deleteItem = function(item) {

            deleteData(item.ID);

            var index = $scope.data_bio.indexOf(item);
            $scope.data_bio.splice(index, 1);
        }

        //end deleteitem
        $scope.tryAddItem = function(item) {
            item.tryaddsho = true;

        }

        //end tryeadditem
        $scope.addItem = function(item) {
            //get new id and new timestamp first
            var newId = addData(item.title, item.newItemValue, id, 'bio');

            item.newItemValue = "";
            item.tryaddsho = false;
        }

        //end of add item


        $scope.doneEditing = function(item) {
            item.sho = false;
            item.txtsho = false;
            //$scope.sho = true;
            sendData(item.Value, item.ID);
        }

        $scope.cancelEditing = function(item) {
            item.sho = false;
            item.txtsho = false;
            //alert(item.Cancel);
            item.Value = item.Cancel;
            item.newItemValue = "";
            item.tryaddsho = false;
            //$scope.sho = true;
        }
        //begin of overall ratings
        $scope.getTotal = function(id) {
            //	console.log($scope.data);
            var total = 0;
            var n = $scope.data.length;
            for (var i = 0; i < n; i++) {

                var product = $scope.data[i];

                total += parseInt(product.Value);
            }
			//alert(total);
			if(	isNaN(total) || total == 0){
			return 'No ratings yet';	
			}else {
            return (total / n).toFixed(2);
			};
        }

        function sendData(message, id) {
            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                }
            };

            $http.post('post.php', {
                'message': message,
                'id': id,
                'action': 'edit'
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {
                    if (data == 0) {

                        alert('no change made');
                    } else {
                        alert('done');
                    }

                    // alert(data);
                } else {
                    $scope.errors.push(data.error);
                    throw new Error("my error message");
                    alert('an error has occured while contacting the server');
                }
            }).error(function(data, status) { // called asynchronously if an error occurs
                // or server returns response with an error status.
                throw new Error("my error message");
                alert('an error has occured while contacting the server');
                $scope.errors.push(status);
            });
        }

        $scope.savePicture = function() {
            //making pictureUrlTemp to pictureUrl (current)
            $scope.pictureUrlTemp = $scope.pictureUrl;
            // alert('alert');
            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                }
            };

            $http.post('post.php', {
                'id': id,
                'action': 'updatePicture',
                'PictureID': $scope.newPictureID,

            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {

                    alert('done');
                    //  $scope.error_logs = data;
                } else {
                    $scope.errors.push(data.error);
                    alert('an error has occured while contacting the server');
                }
            }).error(function(data, status) { // called asynchronously if an error occurs
                // or server returns response with an error status.
                alert('an error has occured while contacting the server');
                $scope.errors.push(status);
            });
        }


        function addData(title, value, parent, category) {

            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                }
            };

            $http.post('post.php', {
                'action': 'add',
                'Title': title,
                'Value': value,
                'Parent': parent,
                'Category': category
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {
                    //alert(data);
                    $scope.data_bio.push({
                        Category: 'bio',
                        Parent: id,
                        Value: value,
                        Title: title,
                        ID: data
                    });
                    alert('done');

                } else {
                    $scope.errors.push(data.error);
                    alert('an error has occured while contacting the server');
                }
            }).error(function(data, status) { // called asynchronously if an error occurs
                // or server returns response with an error status.
                alert('an error has occured while contacting the server');
                $scope.errors.push(status);
            });
        }


        function deleteData(id) {
            //alert(id);
            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                }
            };

            $http.post('post.php', {
                'action': 'delete',
                'id': id
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {
                    if (data == 0) {
                        alert('no change made');
                    } else {
                        alert('done');
                    }

                    // alert(data);
                } else {
                    $scope.errors.push(data.error);
                    alert('an error has occured while contacting the server');
                }
            }).error(function(data, status) { // called asynchronously if an error occurs
                // or server returns response with an error status.
                alert('an error has occured while contacting the server');
                $scope.errors.push(status);
            });
        }


        //end of function deleteData

        $scope.hoverIn = function(sho) {
            if (sho) {
                this.hoverEdit = false;

            } else {
                this.hoverEdit = true;
            }
        };

        $scope.hoverOut = function() {
            this.hoverEdit = false;
        };
        //end
    }]);
</script>

</html>