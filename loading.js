function addLoadingMotion(){
	if(needLoading==true){
		document.body.classList.add('loading-body');
	}
}
addLoadingMotion();

window.onload=function(){
	document.body.classList.remove('loading-body');
}