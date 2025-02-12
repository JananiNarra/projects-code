function check()
{
	var pattern=/@srmap.edu.in/;
	var str=e.value;
	var c=pattern.test(str);
	if(c)
	{
		return true;
	}
	else
	{
		alert('Email should contain @srmap.edu.in');
		return false;
	}
}