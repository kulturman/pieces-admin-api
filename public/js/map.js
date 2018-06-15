var map;
function initMap()
{
	var position = {
		lat : lat,
		lng : lng,
	};
	
	map = new google.maps.Map(document.getElementById('map'), {
		center: position,
		zoom: 5
	});

	var marker = new google.maps.Marker({
		position: position,
		map: map,
		draggable: true
	});

	var searchBox = new google.maps.places.SearchBox(document.getElementById('search_map'));
	google.maps.event.addListener(searchBox , 'places_changed' , function()
	{
	   var places = searchBox.getPlaces();
	   var bounds = new google.maps.LatLngBounds();
	   var i ,place;
	   
	   for(i = 0 ; place = places[i] ; i++)
	   {
		   bounds.extend(place.geometry.location);
		   marker.setPosition(place.geometry.location);
	   }
	   
	   map.fitBounds(bounds);
	   map.setZoom(13);
	});
	
	google.maps.event.addListener(marker , 'position_changed' , function()
	{
		var lat = marker.getPosition().lat();
		var lng = marker.getPosition().lng();
		$('#coords').text(lng + ';' + lat);
	});
}