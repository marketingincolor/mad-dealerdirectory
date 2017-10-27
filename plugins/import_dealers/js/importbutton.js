// JavaScript Document

function setSubmit(){
		document.getElementById("my_submit_button").disabled=false;
	}
        
// loading message
function messageFun() {
    var div = document.getElementById('loadingMessage');
    div.innerHTML = div.innerHTML + 'Uploading....';
}