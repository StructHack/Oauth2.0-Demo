var a = document.getElementsByTagName('a');
for(let i=0; i<a.length; i++){
	a[i].addEventListener('click',function(){
		document.getElementById('sub').value=a[i].innerHTML;
		document.getElementById('granttype').value=(a[i].innerHTML).toLowerCase();
	});
}