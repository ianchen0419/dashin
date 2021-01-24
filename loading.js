function addLoadingMotion(){
	if(!localStorage['firstAccess']){
		document.body.classList.add('loading-body');
	}
	localStorage['firstAccess']=true;
}
addLoadingMotion();

window.onload=function(){
	document.body.classList.remove('loading-body');
}