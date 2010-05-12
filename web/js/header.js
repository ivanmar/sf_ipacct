function reload(num)
{
	obj=document.getElementById("form1");
	obj.loop.value=num;
	obj.submit();
}

function restart(interval)
{
	recordAjax.stop();
	countAjax.stop();
	
	refresh(interval);
}

function refresh(time)
{
	recordAjax = new Ajax.PeriodicalUpdater(container1,url1,
	{ asynchronous:true,frequency:time,method:'get',parameters:pars1 });
	countAjax = new Ajax.PeriodicalUpdater(container2,url2,
	{ asynchronous:true,frequency:time });
}
 
function ping(time)
{
	recordAjax = new Ajax.PeriodicalUpdater(container1,url1,
	{ asynchronous:true,frequency:time,method:'get',parameters:pars1 });
}

function logrefresh(interval)
{
	ltype=$('ltype').value;
	last=$('last').value;
	kword=$('kword').value;
	pars2='log='+ltype+'&lines='+last+'&keyword='+kword;
	
	radiusAjax.stop();
	log(interval);
}

function log(time)
{
	uptimeAjax = new Ajax.PeriodicalUpdater(container3,url3,
	{ asynchronous:true,frequency:time,method:'get',parameters:pars3 });
	radiusAjax = new Ajax.PeriodicalUpdater(container2,url2,
	{ asynchronous:true,frequency:time,method:'get',parameters:pars2 });
}

function status(time)
{
	statusAjax = new Ajax.PeriodicalUpdater(container1,url1,
	{ asynchronous:true,frequency:time,method:'get',parameters:pars1 });
}

function putFocus(formInst, elementInst)
{
	if(document.forms.length > 0)
		document.forms[formInst].elements[elementInst].focus();
}

function populate()
{
	var chunk="";
	
	for(i=0;i<document.upgrade.archive.options.length;i+=1)
		chunk+=document.upgrade.archive.options[i].value+"\n";
	document.upgrade.files.value=chunk;
}

function addItem()
{
	var f=document.upgrade.fname;
	var a=document.upgrade.archive;
	
	for(i=0;i<f.options.length;i++)
	if(f.options[i].selected)
	{
		cnt=0;
		
		for(j=0;j<a.options.length;j++)
			if(f.options[i].value==a.options[j].value) cnt++;
		
		if(cnt==0)
		{
			file=f.options[i].value;
			addOpt=new Option(file,file);
			len=a.options.length;
			a.options[len]=addOpt;
		}
	}
	populate();
}

function delItem()
{
	delOpt=document.upgrade.archive;
	for(i=delOpt.length-1;i>=0;i--)
		if(delOpt.options[i].selected) delOpt.remove(i);
	populate();
}
