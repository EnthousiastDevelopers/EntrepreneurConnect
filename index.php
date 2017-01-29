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
    <title>EntrepreneurConnect</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <!-- <link rel="stylesheet" href="assets/css/style.css">-->
    <link rel="stylesheet" href="assets/css/styles.css">
	
    <script src="assets/js/angular.min.js"></script>
	<script src="assets/js/ng-file-upload.js"></script>
    <script src="assets/js/angular-sanitize.js"></script>
    <script src="assets/js/angular-filter.js"></script>
    <script src="assets/js/angular-route.min.js"></script>
    <script src="assets/js/lodash.min.js"></script>
	 <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   

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
           <!-- <li><a href="{{ProfileUrl}}" ng-click="ToggleMode('Profile');">My Profile</a></li>-->
            <li><a href="#myProfileDudeIwannaSeeIt" ng-click="setProfileViewID(myid); reloadProfileData();SetIfModeEdit(); ToggleMode('Profile');">My Profile</a></li>
			
			<li><a href="#myAwsomeAccount" ng-click="ToggleMode('MyAccount'); get_myDataUser();">My Account</a></li>
        </ul>
    </div>
	<div id="notification">
	<h1>Notifications</h1>
	<ul>
            <li><a href="#Flag" ng-click="ToggleNotification('FlagRed');">Red Flag</a></li>
            <li><a href="#Flag" ng-click="ToggleNotification('FlagGreen');">Green Flag</a></li>
            <li><a href="#Message" ng-click="ToggleNotification('Message'); 	notification.new_message_count = 0;">Message<span ng-if="notification.new_message_count != 0" id="new_message_count">({{notification.new_message_count}})</span></a></li>
        </ul>
	</div>
	<div id="message" ng-show="ShowMsgNotification">
	<h1>Message</h1>
	<h3>Inbox</h3>
	<div id="message_inbox_container">
		<div ng-repeat="message in inbox" >
		<div ng-init="message.Class = getInboxClass(message.FromID, message.Status)"  ng-class="message.Class">
			<div href="#ThisSweetConversationYouOpened" ng-init="message.Interlocuter = returnNotmyID(message.FromID,message.ToID)" ng-click="OpenChat(message.Interlocuter); message.Class='message_inbox'">
				<div><span ng-hide="message.FromID==myid" class="message_inbox_sender">{{message.FirstName}} {{message.LastName}}</span><span ng-show="message.FromID==myid" class="message_inbox_sender">You</span>: <span class="message_inbox_value">{{message.Value}}</span></div>
				<div class="message_inbox_timestamp">{{message.Timestamp}}</div>
			</div>
		</div>
		</div>
	</div>
	</div>
    <div id="preference" ng-if="Mode=='preference'">
        <h1>What are you looking for?</h1>
		<form>
        <div ng-repeat="preference in preferences">
            <span ng-hide="false">
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="radio" value="{{preference.id}}" name = "preferences" ng-model="myPreference.pref_id" />
	<label>{{preference.Title}}</label></span> <span ng-hide="false">
	<br>
	</div>
	<br>
<input id = "id 1" type="submit" class="class 1" placeholder="your placeholder 1" type="button" value="GET STARTED" name = "name 1"  ng-click='updatePreference()'/>
</form>
	</div>
	
	
	<div id="search" ng-if="Mode=='Search'">
	<h1>Search</h1>
	<h2>Search people by personality</h2>
<h3>Bio search</h3>	
	<ul >
	<li ><span>
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1" ng-checked="true"  ng-model='all_bio_search'/></span><span>All Bio<span></li>

		<li ng-hide="all_bio_search" ng-repeat="item in bio"><span>
	<input id = "id 1" class="class 1" ng-checked="true" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1"   /></span><span>{{item.Title}}</span></li>
            </ul>

            <a href="#DeepBioSearch" ng-hide="advanced_bio_search" ng-click="advanced_bio_search = true">Advanced bio search</a>
            <a href="#DeepBioSearch" ng-show="advanced_bio_search" ng-click="advanced_bio_search = false">Quick bio search</a>

            <h3>Rating search</h3>
            <span><input type="checkbox" ng-model="has_set_minimum_rating">Set minimum ratings</span>
            <ul>
                <li><span ng-show="has_set_minimum_rating">
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1" ng-checked="true"  ng-model='all_rating_search'/></span><span>All Ratings<span></li>

		<li ng-hide="all_rating_search"  ng-show="has_set_minimum_rating" ng-repeat="item in ratings"><span>
	<input id = "id 1" class="class 1" ng-checked="true" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1"   /></span><span>{{item.Title}}</span></li>
            </ul>

            <div id="toogle quick and advanced rating" ng-show="has_set_minimum_rating">
                <a href="#DeepBioSearch" ng-hide="advanced_rating_search" ng-click="advanced_rating_search = true">Advanced rating search</a>
                <a href="#DeepBioSearch" ng-show="advanced_rating_search" ng-click="advanced_rating_search = false">Quick rating search</a>
            </div>



            <div id="advanced_bio_search">
                <table ng-show="advanced_bio_search" class="table table-hover">

                    <tr>
                        <th>Criteria</th>
                        <th ng-hide="true"></th>
                        <th>Keyword</th>
                        <th></th>
                        <th ng-show="true">Search</th>
                    </tr>

                    <tr ng-repeat="item in bio">
                        <td>{{item.Title}}</td>
                        <td ng-hide="true">
                            <input id="id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name="name 1"  /></td>
                        <td><input id="id 1" class="class 1" placeholder="your placeholder 1" type="input 1" value="" name="name 1" onClick='' ng-show="item" /></td>
                        <td ng-show="true"><input type="button" value="Add" onClick='' /></td>
                        <td></td>
                    </tr>
                </table>
            </div>



            <div id="advanced_rating_search">
                <table ng-show="advanced_rating_search" class="table table-hover">
                    <tr>
                        <th>Criteria</th>
                        <th>Keyword</th>
                        <th></th>
                        <th>Search</th>
                    </tr>

                    <tr ng-repeat="item in ratings">
                        <td>{{item.Title}}</td>
                        <td><input id="id 1" class="class 1" placeholder="your placeholder 1" type="input 1" value="" name="name 1" onClick='' /></td>
                        <td><input type="button" value="Add" onClick='' /></td>
                        <td></td>
                    </tr>
                </table>
            </div>

            <div id="confirmsearch">
                <span ng-hide="advanced_bio_search">Value is:<input ng-model="search_data.quick_search_value" width="600" type = "text" placeholder="Value to search" /></span>
                <br>
                <span ng-show="has_set_minimum_rating">and <br>
		<span ng-show="!advanced_rating_search"> Minimum rating: <input ng-model="quick_search_rating"  width="600" type = "text"  type="range" value="4" min="0"  max="5"  step=".5"/></span></span>
                <br>
                <input width="600" type="button" ng-click="search()" ; value="Search" />
            </div>


            <div id="results">
                <span ng-hide="hasSearched">Press the search button to display  results</span>
                <div ng-show="hasSearched" id="resut">
                    <h2>{{numberOfResults}}Results</h2>
                    No results.

                    <div ng-repeat="person in  searchresult | orderBy : '-Rate'">
						<a href="#{{person.FirstName}}" ng-click="setProfileViewID(person.ID); reloadProfileData();SetIfModeEdit(); ToggleMode('Profile');">
			  <!--<a href="index.php?id={{person.ID}}; ToggleMode('Profile'); ">-->
			  
                            <h2>{{$index+1}} - {{person.FirstName}} {{person.LastName}}<span ng-if="person.ID == myid">(you)</span></h2>



                            <img src="{{person.PictureUrl}}" alt="image" height="100" align="left" /> {{person.status}}
                            <h3>
                                <span ng-if="person.Rate!=0">{{person.Rate}} out of 5</span>
                                <span ng-if="person.Rate==0"> Be the first to rate this person</span><br>
                            </h3>
                            {{person.ReviewCount}} Review(s).
                        </a>
                        <div>
                            <h3>Bio:</h3>
                            <div words="search_data.quick_search_value">{{person.VALUESPRO}}</div>
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>


                <br>
                <span ng-if="searchresult !==undefined">
	Do you want to be notified if we find this person later? <br>Yes<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="input 2" name = "name 1"  onClick=''/>
	</span>
            </div>
		<br><br><br><br><br><br><br><br><br>
        </div>
   
    <!--End SEARCH-->
    <!--Start MESSAGING-FLOAT-->
    <div id="message-float" >
			
			<div id="message-float" class="message-float" ng-if="isChatOpened">
				<div id="message-float-container" sng-bind-html="float_chat_boxes">
					<div ng-repeat = "(key, conversations) in messages">
					<div class="float_chat_box" ng-class="{toggleDown:conversations.Hide}">
						<div class="float_chat_box_header">
						<span class="header_name" ng-click="conversations.Hide = !conversations.Hide" id="{{conversations.Interlocuter}} ">{{conversations.FirstName}} {{conversations.LastName}}</span>
						<span class="windows_controller">
						<a href="#expandThis" ng-show="conversations.Hide" ng-click="conversations.Hide = false">expand</a>
						<a href="#reducethis" ng-show="!conversations.Hide" ng-click="conversations.Hide = true">reduce</a>
						<a href="#closethis" ng-click="removeConversation(key)">close</a>
						</span>
						<br>
						</div>
						
						<div class="float_chat_box_body" scroll-Bottom="conversations">
				
						<div ng-repeat ="message in conversations" >
						<div ng-class="check_message_senderID('{{message.FromID}}')">
							<div class="chat_name">{{message.FirstName}} {{message.LastName}}</div>
							<div class="chat_content">
								<span class="message">{{message.Value}}</span>
								<br>
								<span class="timestamp">{{message.Timestamp}}</span>
							</div>
						{{message.reply}}
						</div>
						<!--<br>-->
						</div>
						
						</div>
						
						<div class="float_chat_box_footer">
						<form id="float_chat_box_form" ng-submit="sendMessage($index, message.reply);">
						<span><input id="float_chat_box_input" type="text" ng-model ="conversations.reply" placeholder="Your message here"></span>
						<span><input type="button"  value="Send"  type="submit" ng-click="sendMessage($index, message.reply);"/></span>
						</form>
						</div> {{message.reply}}
					</div> <!--end float_chat_box -->
					</div> <!--end ng-repeat conversations in messages -->
				</div>
			</div>
		</div>
	<!--End MESSAGING-float-->
	
    <!--Start EXPLORE-->


    <div id="explore" ng-if="Mode=='Explore'">
        <h1>Explore</h1>
        Rank:
        <div ng-repeat="person in  data_people | orderBy : '-Rate'">
            <a href="#{{person.FirstName}}" ng-click="setProfileViewID(person.ID); reloadProfileData();SetIfModeEdit(); ToggleMode('Profile');">
			  <!--<a href="index.php?id={{person.ID}}; ToggleMode('Profile'); ">-->
                <h2>{{$index+1}} - {{person.FirstName}} {{person.LastName}}<span ng-if="person.ID == myid">(you)</span></h2>



                <img src="{{person.PictureUrl || 'uploads/basic-profile.png'}}" alt="image" height="100" align="left" /> {{person.status}}
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
            <h3>ID: {{info.ID}}</h3>
            <h3>Name: {{info.FirstName}} {{info.LastName}}</h3>
            <h3>Username: {{info.Username}}</h3>
            <h3>Email: {{info.Email}}</h3>
            <h3>Password: {{info.Password}}</h3>
            <h3>Member since: {{info.Creation}}</h3>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div id="MyProject" ng-show="Mode=='MyProjects'">
        <h1>My Projects</h1>
    0 projects.
	</div>
    <div id="profile" ng-if="Mode=='Profile'">

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
		<span id="a bit of message">
			<span id="message-button" ng-if="!ModeEdit" >
				<button type="button" ng-click="OpenChat(id)">Message</button>
			</span>
		</span>
        <input ng-if="!ModeEdit" ng-hide="RatePersonBool()" id="id 1" class="class 1" placeholder="your placeholder 1" type="button" value="Rate this person" name="name 1" ng-click="rateEditOn()" />
		

        <div id="Ratings">

            <div ng-show="RateEditMode" id="Ratings-Edit">
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
                                        1 <input id="rating-1" class="rating-1" placeholder="" type="radio" value="1" ng-model="rating.Value" name="{{rating.Title}}" onClick='' />
                                        <input id="rating-1" class="rating-1" placeholder="" type="radio" ng-model="rating.Value" value="2" name="{{rating.Title}}" onClick='' />
                                        <input id="rating-1" class="rating-1" placeholder="" type="radio" ng-model="rating.Value" value="3" name="{{rating.Title}}" onClick='' />
                                        <input id="rating-1" class="rating-1" placeholder="" ng-checked="true" type="radio" ng-model="rating.Value" value="4" name="{{rating.Title}}" onClick='' />
                                        <input id="rating-1" class="rating-1" placeholder="" type="radio" ng-model="rating.Value" value="5" name="{{rating.Title}}" onClick='' /> 5</td>
                                    <td>{{rating.Value}}</td>
                                    <td><input type="text" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input id="id 1" class="class 1" placeholder="your placeholder 1" type="button" value="Submit My Ratings" ng-hide="IalreadyRated" name="name 1" ng-click='submitRating()' />
                    <input id="id 1" class="class 1" placeholder="your placeholder 1" type="button" value="Save Edits" ng-show="IalreadyRated" name="name 1" ng-click='ConfirmEditRating()' />
                    <input id="id 1" class="class 1" placeholder="your placeholder 1" type="button" value="Cancel" name="name 1" ng-click=' cancelEditRatings();;' />
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
                    <input id="id 1" class="class 1" placeholder="your placeholder 1" type="button" value="Edit My Ratings" name="name 1" ng-click='rateEditOn(); EditMyRatings();' />

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

    //var fetch_bio = angular.module('fetch_bio', ['ngRoute','angular.filter','ngSanitize']);
    var fetch_bio = angular.module('fetch_bio', ['ngRoute', 'angular.filter', 'ngFileUpload', 'ngSanitize']);
	var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                }
            };

	

    ///<----DIRECTIVES--->///
    fetch_bio.directive('words', function() {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                scope.$watch(attrs.words, function(newValue) { //watch
                    // var words = element.attr('words').split(' ');
                    //  var words = scope.words.split(' ');
                    var words = newValue.split(' ');
                    for (var i = 0; i < words.length; i++) {
                        var r = new RegExp(words[i], 'ig')
                        element.html(element.html().replace(r, '<span class="highlight">' + words[i] + '</span>'));
                    }
                }); //watch
            }
        };
    })

		fetch_bio.directive('scrollBottom', function () {
		  return {
			scope: {
			  scrollBottom: "="
			},
			link: function (scope, element) {
			  scope.$watchCollection('scrollBottom', function (newValue) {
				if (newValue)
				{
				  $(element).scrollTop($(element)[0].scrollHeight);
				}
			  });
			}
		  }
		})
    fetch_bio.directive('myTextHighlither', function() { //not working
        return {
            restrict: 'A',
            template: '<div><span ng-repeat="word in words" class="single-word" ng-click="highlight($event)">{{word}}</span></div>',
            link: function($scope, $element) {
                $scope.words = $element.attr('words').split(' ');
                $scope.highlight = function(event) {
                    angular.element(event.target).toggleClass('highlight');
                };
            }
        };
    });
    ///<----/DIRECTIVE--->///



    fetch_bio.controller('dbCtrl', ['$scope', '$http', 'Upload', '$route','$timeout', function($scope, $http, Upload, $route, $timeout) {
        // fetch_bio.controller('dbCtrl', ['$scope', '$http','$route', function($scope, $http, $route) {
//<--GET  DATA  -->


$scope.reloadProfileData = function () {
	

  //AUTO-GET 1) Autorun function get current data_user (basic)
        $http.get('get.php?q=user&id=' + id + '')
            .success(function(data) {
				console.log('the opened profile id is: '+id+' and your id is: '+myid);
                $scope.data_user = data;
                console.log('data_user');
                console.log(data);
				
                // $scope.error_logs = data;
                //    alert($scope.data_user[0].PictureID);
            })
            .error(function() {
                $scope.data_user = "error in fetching data";
            });

			//get_myDataUser:
 //AUTO-GET 2) Autorun function get current my_data_user (basic)   
                $http.get('get.php?q=user&id=' + myid + '')
                    .success(function(data) {
                        $scope.my_data_user = data;
                        console.log('my_data_user');
                        console.log('my_data_user');
                        console.log(data);
      //setting up Mode
var oldURL = document.referrer;
// alert(oldURL);
if(oldURL.includes("login")){ //if the referrer
	  // if(!$scope.hasSetSessionPreferences && !myid==id){
		  // alert($scope.hasSetSessionPreferences);
							if($scope.my_data_user[0].FirstInterest == null) {
										$scope.Mode = 'preference';
										console.log('Mode: firstInterest null');
										console.log($scope.Mode);
							
							}else {
										console.log('Mode');
										console.log($scope.my_data_user[0].FirstInterest);
										console.log($scope.Mode);
										var pos = $scope.preferences.map(function(e) {
											return e.id;
										}).indexOf(parseInt($scope.my_data_user[0].FirstInterest)); 
											if($scope.my_data_user[0].FirstInterest == 3) {
												$scope.getDataPeople(); //special case for mode explore
											};
										// alert(pos);
										$scope.Mode = $scope.preferences[pos].Mode;
										console.log('Mode');
										console.log($scope.Mode);
											
				
                        }//end setting up mode
						$scope.hasSetSessionPreferences = true;
                  }//end if hasSetSessionPreferences
                        // $scope.error_logs = data;
                        // alert($scope.data_user[0].PictureID);
                    })
                    .error(function() {
                        $scope.my_data_user = "error in fetching data";
                    });
            
        
//AUTO-GET 3) get data_bio current opened profile
        $http.get('get.php?q=profile&c=bio&id=' + id + '')
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


}//end of function reloadProfileData
//<--/GET DATA -->

        ///<----VARIABLES--->///
	$scope.play = function(song) {
		var audio;
		if(song == 'blip') {
        var audio = new Audio('assets/audio/alert_msg.mp3');
			
		}
        audio.play();
    };
				$scope.reloadProfileData();
		$scope.hasSetSessionPreferences = false;
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
        $scope.preferences = [{
                "id": 1,
                "Title": "I want to know myself and be inspired to get ideas",
                "Mode": "Profile",
              
            },
            {
                "id": 2,
                "Title": "I want to build a team for my business",
                "Mode": "Search",
            },
            {
                "id": 3,
                "Title": "I Just want to discover and connect with entrepreneurs",
                "Mode": "Explore",
            }, {
                "id": 4,
                "Title": "I have a business idea and I want to develop it",
                "Mode": "MyProjects",
            }, {
                "id": 5,
                "Title": "All",
                "Mode": "Profile",
            }
        ];



        ///<----PREFERENCES--->///

$scope.myPreference = {};		
$scope.myPreference.pref_id = 'nulle';		
$scope.updatePreference = function() {
	     var pref_id = $scope.myPreference.pref_id;
	//alert($scope.myPreference.pref_id);
		

           $http.post('post.php', {
                'id': myid,
                'preferenceID': pref_id,
                'action': 'updatePreference'
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {

                    $scope.searchresult = data;
                    //$scope.error_logs = data;
                    console.log(data);
                    // alert(data);
					if(data == 1) {
						alert('done');
						  location.reload();
					}
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
        ///<----/PREFERENCES--->///
		///<---NOTIFICATION--MESSAGING--->///
		$scope.ShowMsgNotification = false;
	
		$scope.ToggleNotification = function (item){
			if(item == 'Message') {
				$scope.ShowMsgNotification = !$scope.ShowMsgNotification;
			}
		}
		///<---/NOTIFICATION--MESSAGING--->///
        ///<----MESSAGING--->///
		$scope.messages = [];
		
		$scope.check_message_senderID = function (thisid) {
			if(thisid == myid){
				return 'sent';
			}else {
				return 'received';
			}
		};
		$scope.returnNotmyID = function (a, b) {
			//alert(a);
			if(a != myid) {
				return a;
			}else {
				return b;
			}
		}
		$scope.sendMessage = function (index, Message) {
			var FromID = myid;
			var ToID = $scope.messages[index].Interlocuter;
			var Value = $scope.messages[index].reply;
			var Timestamp = 'Just Now';
			//alert(Value);
			///console.log(Value);
			// alert(index);
			     $http.post('post.php', {
                'FromID': FromID,
                'ToID': ToID,
                'action': 'sendMessage',
                'Value': Value
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {
					if(data == 1) {
						//alert('done');
						$scope.messages[index].push({"FromID":FromID,"ToID": ToID, 'Value': Value, "Timestamp":Timestamp});
					}else {
					$scope.error_logs = data;
                    alert('an error has occured while contacting the server');
					}
                } else {
                    $scope.errors.push(data.error);
                    throw new Error("my error message");
                }
            }).error(function(data, status) { // called asynchronously if an error occurs
                // or server returns response with an error status.
                alert('an error has occured while contacting the server');
                throw new Error("my error message");
                $scope.errors.push(status);
            }); //end http post
			$scope.messages[index].reply = ''; //reset reply of this conversations of sending it
		};
		$scope.removeConversation = function (index) {
			
			 $scope.messages.splice(index, 1);
              console.log($scope.messages);
		}
        $scope.OpenChat = function (idOnScreen) {
		//	alert(idOnScreen);
			$scope.isChatOpened = true;
			var pos = $scope.messages.map(function(e) { return e.Interlocuter; }).indexOf(idOnScreen);
			if(pos != -1) {
				alert('chat is already opened');
				console.log('chat is already opened is $scope.messages indexOf: '+pos);
				return null;
			}
			var length = $scope.messages.length;
			if(length == 4) {
				$scope.removeConversation(0);
			}
			//position 
			$http.get('get.php?q=messages&myid='+myid+'&id='+idOnScreen)
			.success(function(data) {
				console.log('messages from id:'+idOnScreen);
//                    console.log(data);
			//   $scope.error_logs = data;
			    var ToMyidSnippets = _.filter(data, {
                    'FromID': idOnScreen
                });
				var FromMyidSnippets = _.filter(data, {
                    'FromID': myid
                });
					console.log(ToMyidSnippets);
					console.log(FromMyidSnippets);
					if((ToMyidSnippets.length) !=0) {
			   data['FirstName'] = ToMyidSnippets[0]['FirstName'];
			   data['LastName'] = ToMyidSnippets[0]['LastName'];
					}else if((FromMyidSnippets.length) !=0){
			   data['FirstName'] = FromMyidSnippets[0]['ToFirstName'];
			   data['LastName'] = FromMyidSnippets[0]['ToLastName'];
					}else {
						data['FirstName'] = $scope.data_user['FirstName'];
						data['LastName'] = $scope.data_user['LastName'];
					}
				
			   data['Interlocuter'] = idOnScreen;
				$scope.messages.push(data); //add new open chat
			console.log($scope.messages);
			}) //</success get>
			.error(function() {
				$scope.data_people = "error in fetching data";
			});
		}//end get message
		$scope.notification = []; 
		$scope.notification.new_message_count = 0;
		$scope.get_new_message_count  = function () {
			  angular.forEach($scope.inbox, function(parent) {
			  if( parent['Status'] == '0' && parent['FromID']!=myid) {
				$scope.notification.new_message_count ++;	
				//  alert($scope.notification.new_message_count);
			  }
			  });
		}
		$scope.get_last_received_msg_ID = function () {
				$http.get('get.php?q=check_updates&myid='+myid+'&id=')
					.success(function(data) {
					console.log('last message ID received: '+data);
					// alert(data);
					//$scope.error_logs = data;
					$scope.notification.last_msg_received_ID = data;
					console.log($scope.messages);
					}) //</success get>
					.error(function() {
					$scope.data_people = "error in fetching data";
					});	
		};
		
		$scope.getInboxClass = function (From, Status) {
			// console.log(Status+','+From+','+myid);
		if(From != myid && Status == '0') {
			return 'message_inbox unseen';
		}else {
			return 'message_inbox';
		}
		};
		$scope.getInbox = function () {
				$http.get('get.php?q=inbox&myid='+myid+'&id=')
					.success(function(data) {
					// alert(data);
					//$scope.error_logs = data;
					$scope.inbox = data;
					console.log('inbox: ');
					console.log($scope.inbox);
					$scope.get_new_message_count();
					}) //</success get>
					.error(function() {
					$scope.data_people = "error in fetching data";
					});	
		}
		$scope.update_opened_chat = function () {
			if(($scope.messages).length == 0){
				return null;
			};
			  var ids = []; 
			  angular.forEach($scope.messages, function(parent) {
			  ids.push(parent['Interlocuter']);
			  });
			  console.log('chat ids to check for update: ');
			  console.log(ids);
            $http.post('post.php', {
                'Interlocuter': ids,
                'myid': myid,
                'action': 'update_opened_chats'
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {

                  // $scope.searchresult = data;
                     console.log('result for update_opened_chat:');
                     $scope.error_logs = data;
                     console.log(data);
					 angular.forEach(data , function (snippet_mgs) { //loop throught results unseen message fetched
						  var pos = $scope.messages.map(function(e) { return e.Interlocuter; }).indexOf(snippet_mgs['FromID']); //find the position of that snippet FromID inside $scope.messages[Interlocuter]
						  $scope.messages[pos].push(snippet_mgs);
						  console.log(pos);
						  console.log($scope.messages);
					 });
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
		
		$scope.getInbox();
		$scope.get_last_received_msg_ID();
		$scope.isChatOpened = false;
		///<----/MESSAGING--->///
		///<----SERVER LISTENER--->///
		$scope.check_updates = function() {
				console.log('checking updates...');
		  $timeout(function () {
					
					$http.get('get.php?q=check_updates&myid='+myid+'&id=')
					.success(function(data) {
					// $scope.error_logs = data;
					 //console.log($scope.messages);
					 if(data != $scope.notification.last_msg_received_ID) {
						 //alert('new message received');
						 $scope.play('blip');
						 $scope.notification.last_msg_received_ID = data; //update the marker last_msg_received_ID in order to stop receiving alert
						 $scope.getInbox(); //refresh the whole inbox to see second level checking (by senderID)
						 console.log(data);
						 $scope.update_opened_chat();//refresh the opened chats
					 }else {
						console.log('messages up to date');
					//	console.log(data);
					 } //end if data different from last_msg_received_ID
					}) //</success get>
					.error(function() {
					$scope.data_people = "error in fetching data";
					});	
					
				$scope.check_updates();
		  }, 5000);	
		}
		$scope.check_updates(); //comment or uncomment to disable/enable message-instant notification
		
		$scope.check_for_updates = function (){
			$http.get('get.php?q=check_updates&myid='+myid+'&id='+idOnScreen)
			.success(function(data) {
				console.log('messages from id:'+idOnScreen);
//                    console.log(data);
			   // $scope.error_logs = data;
			   data['Interlocuter'] = id;
				$scope.messages.push(data);
			console.log($scope.messages);
			}) //</success get>
			.error(function() {
				$scope.data_people = "error in fetching data";
			});	
		}
		
		
		///<----/SERVER LISTENER--->///
        ///<----EXPLORE--->///
        $scope.getDataPeople = function() {

            $http.get('get.php?q=explore&id=idsOnScreen')
                .success(function(data) {
                    $scope.data_people = data;
                    console.log('data_people');
                    console.log(data);
                    // $scope.error_logs = data;
                    // alert('pictureID is: '+ pictureID);
                    if (typeof($scope.data_explore_bio) == 'undefined') {
                        get_data_explore_bio();
                    } else {

                        lookup_explore_pictureURL();
                        lookup_explore_reviews();
                    } //else
                }) //</success get>
                .error(function() {
                    $scope.data_people = "error in fetching data";
                });

        }




        function get_data_explore_ratings() {

            $scope.titles_list = _.uniq(_.map($scope.data_explore_bio, 'Parent'));

            $scope.modifiedData = [];
            angular.forEach($scope.titles_list, function(parent) {
                var eachCategory_temp = _.filter($scope.data_explore_bio, {
                    'Parent': parent
                });
                eachCategory = _.filter(eachCategory_temp, {
                    'Category': 'ratings'
                });

               // console.log('eachCategory');
               // console.log(eachCategory);
                var sum = 0;
                _.map(eachCategory, function(each) { //iterate other filtered category
                    sum += parseInt(each.Value); //incrementing the sum of this category
                }); //end of iteration
                var ReviewCount = _.uniq(_.map(eachCategory, 'Author')).length;
                if (!$scope.modifiedData[parent]) {
                    var Rate = +(sum / eachCategory.length).toFixed(2);

                    if (isNaN(Rate)) {
                        Rate = 0;
                    }
                    $scope.modifiedData.push({
                        'Parent': parent,
                        'Value': Rate,
                        'ReviewCount': ReviewCount
                    });
                }
            });
            console.log('modifiedData');
            console.log($scope.modifiedData);
            lookup_explore_reviews();

        }


        function lookup_explore_reviews() {
            var filtered = [];
            angular.forEach($scope.data_people, function(item, key) { //lookup average ratings, reviewcount from id in data_people to Parent in modifiedData

                var pos = $scope.modifiedData.map(function(e) {
                    return e.Parent;
                }).indexOf(item.ID); //position in modifiedData where Parent equals item.ID (or $scope.data_people.ID)
                //alert(pos);
                if (pos >= 0) {
                    $scope.data_people[key].ReviewCount = $scope.modifiedData[pos].ReviewCount;

                    $scope.data_people[key].Rate = $scope.modifiedData[pos].Value;
                    //alert($scope.modifiedData[pos].Value);
                } else {
                    $scope.data_people[key].ReviewCount = 0;
                    $scope.data_people[key].Rate = 0;
                }

            }); //for each lookup
        }

        function lookup_explore_pictureURL() {
            var filtered = [];
            angular.forEach($scope.data_people, function(item, key) { //lookup profile picture from id in data_people to value in data_explore_bio

                var pos = $scope.data_explore_bio.map(function(e) {
                    return e.ID;
                }).indexOf(item.PictureID);
                if (pos != 0) {
                    $scope.data_people[key].PictureUrl = $scope.data_explore_bio[pos].Value;
                    //alert($scope.data_explore_bio[pos].Value);
                } else {
                    $scope.data_people[key].PictureUrl = 'uploads/basic-profile.png';
                }

            }); //for each lookup
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
        ///<----SEARCH--->///

        $scope.all_bio_search = true;
        $scope.all_rating_search = true;

        $scope.advanced_bio_search = false;
        $scope.advanced_rating_search = false;

        $scope.hasSearched = false;
        $scope.has_set_minimum_rating = false;

        $scope.search_data = {};
        $scope.search_data.quick_search_value = '';
        $scope.quick_search_rating = 4;


        $scope.search = function() {
            //alert($scope.search_data.quick_search_value);
            $scope.hasSearched = true;
            var search_value;
            var search_rating;
            if (!$scope.advanced_bio_search) {
                if ($scope.all_bio_search) {
                    search_value = $scope.search_data.quick_search_value;
                  //  alert($scope.search_data.quick_search_value);
                } else {
                    //
                } //if quick search but bio filtered
            } else {

            } //end if advanced bio search
            if ($scope.has_set_minimum_rating) {
                if (!$scope.advanced_rating_search) {
                    if ($scope.all_rating_search) {
                        search_rating = $scope.quick_search_rating;
                        alert($scope.quick_search_rating);
                    } else {
                        //
                    } //if quick search but rating filtered
                } else {

                } //end if advanced rating search
            } //end if has_set_minimum_rating

            //searchpost
            

            $http.post('search.php', {
                'searchvalue': $scope.search_data.quick_search_value,
                'searchrating': $scope.quick_search_rating,
                'action': 'quicksearch'
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {

                    $scope.searchresult = data;
                    // $scope.error_logs = data;
                    console.log(data);
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
        ///<----/SEARCH--->///

        // alert(id);

        //setting url for my profile on menu
        $scope.Mode = 'Profile';
        $scope.ModeEdit = 0;
        $scope.IalreadyRated = false;

        $scope.id = id;
        $scope.myid = myid;
        $scope.ConfirmEditRating = function() {
            $scope.answerRatingsID = [];
            angular.forEach($scope.ratings, function(rating) {
                obj = {};
                val = {};
                val[rating.Title] = rating.Value;
                obj[rating.ID] = val;
                $scope.answerRatingsID.push(obj);
            });
            console.log('answerRatingsID');
            console.log($scope.answerRatingsID);
            

            $http.post('post.php', {
                'message': $scope.answerRatingsID,
                'id': id,
                'authorID': myid,
                'action': 'EditMyRatings'
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {
                    if (data == '1') {
                        //$route.reload();
                        location.reload();
                        alert('done!');
                    } else {
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


        $scope.EditMyRatings = function() {

            var newdata = [];
            for (var i in $scope.data) {
                if ($scope.data[i].Author == myid) {
                    //alert($scope.data[i].Title);
                    newdata.push(angular.copy($scope.data[i]));
                    var pos = $scope.ratings.map(function(e) {
                        return e.Title;
                    }).indexOf($scope.data[i].Title);
                    //alert(pos);
                    $scope.ratings[pos] = angular.copy($scope.data[i]);
                }
            }
            console.log($scope.ratings);
            // console.log(newdata);
            $scope.ratings_temp = angular.copy($scope.ratings);
            // $scope.ratings = newdata;
        }
        $scope.IalreadyRatedOff = function() {
            $scope.IalreadyRated = false;
        };
        $scope.IalreadyRatedOn = function() {
            $scope.IalreadyRated = true;
        };
		$scope.SetIfModeEdit = function () {
			if (myid != id) {
				$scope.ModeEdit = 0;
				$scope.ProfileUrl = 'index.php';
			} else {
				$scope.ModeEdit = 1;
				$scope.ProfileUrl = '#MyAwesomeProfile';
			}
		}
		$scope.SetIfModeEdit();
		
        $scope.ToggleMode = function(Mode) {
            $scope.Mode = Mode;
        }
		$scope.setProfileViewID = function(ID) {
			//alert(ID);
            $scope.id = ID;
            id = ID;
        }
		
        $scope.RatePersonBool = function() {
            if (!$scope.IalreadyRated && $scope.RateEditMode) {
                //alert();
                return true;
            } else if ($scope.IalreadyRated && !$scope.RateEditMode) {
                //alert();
                return true;
            } else if ($scope.IalreadyRated) {
                return true;
            } else {
                //alert();
                return false;
            }
        }

        $scope.rateEditOn = function() {
            $scope.RateEditMode = true;
        }
        $scope.rateEditOff = function() {
            $scope.RateEditMode = false;
        }
        $scope.cancelEditRatings = function() {
            if ((typeof $scope.ratings_temp !== 'undefined')) {
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
            for (var i = 0; i < values.length; i++) {
                sum += parseInt(values[i].Value)
            }

            return (sum / values.length).toFixed(2);
        };


        //checkif I already rated just once
        function checkifIalreadyrated() {

            var unique = {};
            var distinct = [];
            for (var i in $scope.data) {
                if (typeof(unique[$scope.data[i].Author]) == "undefined") {
                    distinct.push($scope.data[i].Author);
                    if ($scope.data[i].Author == myid) {
                        // alert($scope.data[i].Author);
                        $scope.IalreadyRated = true;
                    }
                }
                unique[$scope.data[i].Author] = 0;
            }

        }
        //end of checkif I already rated just once


        $scope.getNumberOfRate = function() {

            var unique = {};
            var distinct = [];
            for (var i in $scope.data) {
                if (typeof(unique[$scope.data[i].Author]) == "undefined") {
                    distinct.push($scope.data[i].Author);
                }
                unique[$scope.data[i].Author] = 0;
            }
            return distinct.length;
        }


        $scope.submitRating = function() {
            $scope.answerRatingsID = [];
            angular.forEach($scope.ratings, function(rating) {
                obj = {};
                obj[rating.Title] = rating.Value;
                $scope.answerRatingsID.push(obj);
            });
            

            $http.post('post.php', {
                'message': $scope.answerRatingsID,
                'id': id,
                'authorID': myid,
                'action': 'AddRating'
            }, config).success(function(data, status, headers, config) {
                if (data.msg != '') {
                    if (data == '1') {
                        location.reload();
                        alert('done');
                        //$window.location.reload();//reload the entire page
                    } else {
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



        //upload file
        $scope.onFileSelect = function(file) {
            alert('file selected, don\'forget to save it or cancel');
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
  
        $http.get('get.php?q=profile&c=ratings&id=' + id + '')
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
            if (isNaN(total) || total == 0) {
                return 'No ratings yet';
            } else {
                return (total / n).toFixed(2);
            };
        }

        function sendData(message, id) {
            

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