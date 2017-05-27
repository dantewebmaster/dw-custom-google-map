/**
 * The plugin public scripts.
 */
jQuery(document).ready(function ($) {
	/* stops if map does not exists */
	var $map_exist = $('#dw-custom-google-map').length;
	if (!$map_exist) return;
	
	/* set google maps parameters */
	var map_id = $('#dw-custom-google-map');
	
	var $latitude   = map_id.data('latitude'),
		$longitude  = map_id.data('longitude'),
		$map_zoom   = map_id.data('zoom'),
		$marker_url = map_id.data('custom-marker'),
		$main_color = map_id.data('main-color'),
		$saturation = map_id.data('saturation'),
		$brightness = map_id.data('brightness');

	/* we define here the style of the map */
	var style = [
		{
			/* set saturation for the labels on the map */
			elementType: "labels",
			stylers: [
				{saturation: $saturation}
			]
		},  
	    {	/* poi stands for point of interest - don't show these lables on the map */
			featureType: "poi",
			elementType: "labels",
			stylers: [
				{visibility: "off"}
			]
		},
		{
			/* don't show highways labels on the map */
	        featureType: 'road.highway',
	        elementType: 'labels',
	        stylers: [
	            {visibility: "off"}
	        ]
	    }, 
		{ 	
			/* don't show local road labels on the map */
			featureType: "road.local", 
			elementType: "labels.icon", 
			stylers: [
				{visibility: "off"} 
			] 
		},
		{ 
			/* don't show arterial road labels on the map */
			featureType: "road.arterial", 
			elementType: "labels.icon", 
			stylers: [
				{visibility: "off"}
			] 
		},
		{
			/* don't show road labels on the map */
			featureType: "road",
			elementType: "geometry.stroke",
			stylers: [
				{visibility: "off"}
			]
		}, 
		/* style different elements on the map */
		{ 
			featureType: "transit", 
			elementType: "geometry.fill", 
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		}, 
		{
			featureType: "poi",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		},
		{
			featureType: "poi.government",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		},
		{
			featureType: "poi.sport_complex",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		},
		{
			featureType: "poi.attraction",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		},
		{
			featureType: "poi.business",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		},
		{
			featureType: "transit",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		},
		{
			featureType: "transit.station",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		},
		{
			featureType: "landscape",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
			
		},
		{
			featureType: "road",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		},
		{
			featureType: "road.highway",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		}, 
		{
			featureType: "water",
			elementType: "geometry",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" }, 
				{ lightness: $brightness }, 
				{ saturation: $saturation }
			]
		}
	];
		
	/* set google map options */
	var map_options = {
      	center: new google.maps.LatLng($latitude, $longitude),
      	mapTypeControl: false,
      	mapTypeId: google.maps.MapTypeId.ROADMAP,
      	panControl: false,      	
		scrollwheel: false,
      	streetViewControl: false,
      	styles: style,
      	zoom: $map_zoom,
      	zoomControl: false,		  
    }

    /* inizialize the map */
	var map = new google.maps.Map(document.getElementById('dw-google-container'), map_options);
	
	/* add a custom marker to the map */			
	var marker = new google.maps.Marker({
	  	position: new google.maps.LatLng($latitude, $longitude),
	    map: map,
	    visible: true,
		icon: $marker_url,
		animation: google.maps.Animation.DROP, 
	});

	/* play bounce animation on marker click */ 
	function toggleBounce() {
		if (marker.getAnimation() !== null) {
			marker.setAnimation(null);
		} else {
			marker.setAnimation(google.maps.Animation.BOUNCE);
		}
	}
	marker.addListener('click', toggleBounce);

	/* add custom buttons for the zoom-in/zoom-out on the map */
	function CustomZoomControl(controlDiv, map) {
		/* grap the zoom elements from the DOM and insert them in the map */
	  	var controlUIzoomIn = document.getElementById('dw-zoom-in'),
	  		controlUIzoomOut = document.getElementById('dw-zoom-out');
	  		
		controlDiv.appendChild(controlUIzoomIn);
	  	controlDiv.appendChild(controlUIzoomOut);

		/* Set the click event listeners and zoom-in or out according to the clicked element */
		google.maps.event.addDomListener(controlUIzoomIn, 'click', function() {
		    map.setZoom(map.getZoom() +1 )
		});
		google.maps.event.addDomListener(controlUIzoomOut, 'click', function() {
		    map.setZoom(map.getZoom() -1 )
		});
	}
	var zoomControlDiv = document.createElement('div');
 	var zoomControl = new CustomZoomControl(zoomControlDiv, map);

  	/* insert the zoom div on the top left of the map */
  	map.controls[google.maps.ControlPosition.LEFT_TOP].push(zoomControlDiv);
	
	/* center the map when window resize */
	google.maps.event.addDomListener(window, "resize", function() {
		var center = map.getCenter();
		google.maps.event.trigger(map, "resize");
		map.setCenter(center);
	});

});
