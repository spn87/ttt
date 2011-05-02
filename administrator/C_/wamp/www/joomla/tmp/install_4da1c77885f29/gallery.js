function sobi_gallery_loadImage() {
	alert('function');
	advAJAX.submit(document.getElementById("sobi_gallery_form"), 
	{
		onInitialization : function(obj) { 
			alert('onInitialization');
			document.getElementById("sobi_gallery_loader").innerHTML = "<img src='./components/com_sobi2/plugins/gallery/images/loading.gif' >";
		},
		onSuccess : function(obj) {
			document.getElementById("sobi_gallery_galleryEF").innerHTML = obj.responseText;
		},
		onError : function(obj) { 
			alert('');
		}
	}
	);				
	
}