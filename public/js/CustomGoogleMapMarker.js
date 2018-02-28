
function CustomMarker(latlng, map, imageSrc) {
    this.latlng_ = latlng;
    this.imageSrc = imageSrc;

}

CustomMarker.prototype = new google.maps.OverlayView();

CustomMarker.prototype.draw = function() {
    
    
    var div = this.div;
    
    if (!div) {
    
        div = this.div = document.createElement('div');
        
       div.className = "customMarker";


        var img = document.createElement("img");
        img.src = this.imageSrc;
        div.appendChild(img);
        

        this.getPanes().overlayMouseTarget.appendChild(div);
        var me = this;
        google.maps.event.addDomListener(div, "click", function(event) {       
            google.maps.event.trigger(me, "click");
        });
        
        var panes = this.getPanes();
        panes.overlayImage.appendChild(div);
    }
    
    var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
    
    if (point) {
            div.style.left = point.x + 'px';
            div.style.top = point.y + 'px';
    }
};

CustomMarker.prototype.remove = function() {
    if (this.div) {
        this.div.parentNode.removeChild(this.div);
        this.div = null;
    }   
};

CustomMarker.prototype.getPosition = function() {
    return this.latlng; 
};