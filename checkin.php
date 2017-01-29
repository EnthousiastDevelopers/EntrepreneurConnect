    <div id="preference" ng-if="Mode=='preference'">
        <h1>What are you looking for?</h1>
        <div ng-repeat="preference in preferences">
            <span ng-hide="false">
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1"  onClick='some_function()'/>
	<label>{{preference.Title}}</label></span> <span ng-hide="false">
	<br>
	</div>
	<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="checkbox" value="People" name = "name 1"  onClick='some_function()'/><label>All</label>
	<br>
<input id = "id 1" class="class 1" placeholder="your placeholder 1" type="button" value="GET STARTED" name = "name 1"  onClick=''/>
	</div>
	