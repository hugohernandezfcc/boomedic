function USGSOverlay(bounds, image, map) {

  // Initialize all properties.
  this.bounds_ = bounds;
  this.image_ = image;
  this.map_ = map;

  // Define a property to hold the image's div. We'll
  // actually create this div upon receipt of the onAdd()
  // method so we'll leave it null for now.
  this.div_ = null;

  // Explicitly call setMap on this overlay.
  this.setMap(map);

}
 USGSOverlay.prototype = new google.maps.OverlayView();

USGSOverlay.prototype.onAdd = function() {

  var div = document.createElement('div');
   div.className = 'customMarker';


  // Create the img element and attach it to the div.
  var img = document.createElement('img');
  img.src = this.image_;
  div.appendChild(img);

  this.div_ = div;

  // Add the element to the "overlayLayer" pane.
  var panes = this.getPanes();
  panes.overlayLayer.appendChild(div);
   this.getPanes().overlayMouseTarget.appendChild(div);
        var me = this;
        google.maps.event.addDomListener(div, "click", function(event) {       
            google.maps.event.trigger(me, "click");
        });
        
};

USGSOverlay.prototype.draw = function() {

  var overlayProjection = this.getProjection();

  var point = overlayProjection.fromLatLngToDivPixel(this.bounds_);


  // Resize the image's div to fit the indicated dimensions.
  var div = this.div_;
  div.style.left = point.x + 'px';
  div.style.top = point.y + 'px';

};

USGSOverlay.prototype.onRemove = function() {
  this.div_.parentNode.removeChild(this.div_);
  this.div_ = null;
};