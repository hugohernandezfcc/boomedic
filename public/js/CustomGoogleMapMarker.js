function CustomMarker(latlng, map, imageSrc) {
    this.latlng = latlng;
    this.imageSrc = imageSrc;
    // Once the LatLng and text are set, add the overlay to the map.  This will
    // trigger a call to panes_changed which should in turn call draw.
}

CustomMarker.prototype = new google.maps.OverlayView();
customMarker.prototype.setMap(map);
CustomMarker.prototype.draw = function () {
    // Check if the div has been created.

    var div = this.div;
    if (!div) {
        // Create a overlay text DIV
        div = this.div = document.createElement('div');
        // Create the DIV representing our CustomMarker
        div.className = "customMarker";


        var img = document.createElement("img");
        img.src = this.imageSrc;
        div.appendChild(img);
        //add element to clickable layer 
        this.getPanes().overlayMouseTarget.appendChild(div);
        var me = this;
        google.maps.event.addDomListener(div, "click", function (event) {
            google.maps.event.trigger(me, "click");
            console.log('click');
        });

        // Then add the overlay to the DOM
        var panes = this.getPanes();
        panes.overlayImage.appendChild(div);
    }

    // Position the overlay 
        var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
            
        if (point) {
            div.style.left = point.x + 'px';
            div.style.top = point.y + 'px';
        }
};

CustomMarker.prototype.remove = function () {
    // Check if the overlay was on the map and needs to be removed.
    if (this.div) {
        this.div.parentNode.removeChild(this.div);
        this.div = null;
        this.setMap(null);
    }
};

CustomMarker.prototype.getPosition = function () {
    return this.latlng;
};