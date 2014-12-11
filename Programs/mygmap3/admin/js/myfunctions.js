/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var m1,m2,m3,m4;
var newname = new Array();
var langname = new Array();
//Function that send the balloon datas to the file that will save them
function save(success,fail,language)
{
    var longitude,lattitude;
    longitude = $("input[name=longitude]").val();
    lattitude = $("input[name=lattitude]").val();
    homename = $("#marker1").attr('placeholder');
    //$("#save_frm").attr("action","search.php");
    var request = $.ajax({
        url: "Programs/mygmap3/admin/save.php",
        type: "POST",
        data: {
            "longi":longitude,
            "latti":lattitude,
            "homename":homename,
            "language":language
        }
    });
    request.done(function( msg ) {
        if(msg == 1)
            alert(success);
        else
            alert(fail);
    });
 
    request.fail(function( jqXHR, textStatus ) {
        alert(fail + "!!!");
    });
}
    
//Function that created for handling the marker click event for an edit action but it was ignored till now we don't let user edit markers
//And if he want to edit a marker he must delete the current one and create a new one
/*function ihavebeencreatedclickme(marker,event,context,Question)
          {
              newname = prompt(Question);
              context.data=newname;
              $("#marker1").attr({placeholder:newname});
          }*/

//Function that handle the mouse out event of the marker
function mouseoutme()
{
    //Get the infowindow object and if the object is found then close it
    var infowindow = $(this).gmap3({
        get:{
            name:"infowindow"
        }
    });
if (infowindow)
{
    infowindow.close();
}
}

//Function that handle a mouse over on a marker
function mouseoverme(marker, event, context)
{
    //Get the map object
    var map = $(this).gmap3("get"),
    //Get the infowindow object that will show ballon data
    infowindow = $(this).gmap3({
        get:{
            name:"infowindow"
        }
    });
if (infowindow)
{
    if(context.data)
    {
        //Open info windo on the map for a marker
        infowindow.open(map, marker);
        //Set the content of the info window so it will show the data linked with marker which is mouse overed
        infowindow.setContent(context.data);
    }
}
else
{
    if(context.data)
    {
        //Create the infowindow object that will handle markers mouse over event and show markers data
        $(this).gmap3({
            infowindow:
            {
                anchor:marker,
                options:{
                    content: context.data
                    }
            }
        });
    }
}
}

//Function that will prompt user for point name and this question depends to the current language of the use
function myprompt(marker,event,context,Question,language,ttt,QuestionForDelete)
{
    $("#mylayer").data("marker",marker);
    $("#mylayer").data("event",event);
    $("#mylayer").data("context",context);
    $("#mylayer").data("language",language);
    $("#mylayer").data("QuestionForDelete",QuestionForDelete);
        
    $("#myinnerheader_td").html(Question);
    $("#mylayer").show();
    $("#myinnerlayer").show(100);
        
//$("#mylayer").data("mid","from-" + ttt);
}

function emptymyprompt()
{
    $("#mylayer").hide();
    $("#myinnerlayer").hide();
    $("#myinnerlayer").removeData();
    $("input[name^='point']").val("");
}
function altermarker()
{
    i = 0;
    success = 1;
    $("input[name^='point']").each(function()
    {
        if($(this).val() == "")
        {
            alert("Please fill all fields !");
            success = 0;
            return false;
        }
        infos = $(this).attr('name').split("-");
        newname[i] =  $(this).val();
        langname[i]=infos[1];
        i++;
    });
    try
    {
        language = $("#mylayer").data("language");
        marker = $("#mylayer").data("marker");
        eventt = $("#mylayer").data("event");
        context = $("#mylayer").data("context");
        QuestionForDelete = $("#mylayer").data('QuestionForDelete');
            
        $cu = $("#mylayer").gmap3({
            get:marker
        });
            
    //mid = $("#mylayer").data("mid");
    }
    catch(Ex)
    {
        try
        {
            QuestionForDelete = $("#mylayer").data(QuestionForDelete);
            eventt = $("#mylayer").data("event");
            context = $("#mylayer").data("context");
        }
        catch(Ex)
        {
            try
            {
                context = $("#mylayer").data("context");
                QuestionForDelete = $("#mylayer").data(QuestionForDelete);
            }
            catch(Ex2){
            }
        }
    }            
        
    if(success == 0)return;
        
    fullposition = getmyposition(eventt);
    longitude = fullposition[0];
    lattitude = fullposition[1];
    $("#loader_img").show().attr('src','Programs/mygmap3/admin/images/ajax-loader.gif');
    var request = $.ajax({
        url: "Programs/mygmap3/admin/save.php",
        type: "POST",
        data: {
            "longi":longitude,
            "latti":lattitude,
            "names[]":newname,
            "languages[]":langname,
            "language":language
        }
    });
        
    request.done(function(msg) {
        if(msg != 0)
        {
            try{
                infos = msg.split("!!*-*C0dnl0c*-*!!")
                infodata = infos[0];
                infoid = infos[1];
                $("#mylayer").hide();
                $("#myinnerlayer").hide();
                $("#myinnerlayer").removeData();
                $("input[name^='point']").val("");
                addmarker("mymap_div",[{
                    id:infoid,
                    latLng:eventt.latLng,
                    data:infodata,
                    tag: "from"
                }],{
                    draggable:false,
                    icon:new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_greenA" + ".png")
                    },{
                    mouseover:mouseoverme,
                    mouseout:mouseoutme,
                    rightclick:function(marker,event,context){
                        rightclickmarker(marker,event,context,QuestionForDelete)
                        }
                    });
            alert("success");
            $("#loader_img").hide();
        }
        catch(Ex){
                        
        }
    }
    else
        alert("fail");
    });
 
request.fail(function( jqXHR, textStatus ) {
    alert(fail + "!!!");
});
}
    
function rightclickmarker(marker,event,context,Question)
{
    deletemarker = confirm(Question);
    if(deletemarker == 1)
    {
        fullposition = getmyposition(event);
        longitude = fullposition[0];
        lattitude = fullposition[1];
        var request = $.ajax({
            url: "Programs/mygmap3/admin/delete.php",
            type: "POST",
            data: {
                "longi":longitude,
                "latti":lattitude
            }
        });
        console.clear();
        request.done(function(msg)
        {
            if(msg==1)
            {
                var clear = {
                    id:context.id
                    };
                $("#mymap_div").gmap3({
                    clear:clear
                });
            }
            else
            {
                alert("Marker could not be deleted");
            }
        });
        request.fail(function(){
            alert("Fail")
            });
    }
        
}
    
//Function that handle the click event on the map
function clickmee(marker,event,context,QuestionForNewPoint,QuestionForChangingPoint,language,DeletePointQuestion)
{
    tt = new Date();
    ttt = tt.getTime();
    myprompt(marker,event,context,QuestionForNewPoint,language,ttt,DeletePointQuestion);
}

//Function that will split the Latlng of a marker to array[longitude,lattitude]
function getmyposition(event)
{
    fullposition = new String(event.latLng).split(",");
    positions = new Array();
    positions[0]= fullposition[0].substr(1);
    positions[1]= fullposition[1].substr(1,fullposition[1].length-2);
    return positions;
}
    
//Function that handle the rightclick event on the map that will create the marker to which the user want to calculate direction to it
function rightclickme(marker,event,context)
{
    var clear = {
        tag:"to"
    };
    $("#mymap_div").gmap3({
        clear:clear
    });
    $("#mymap_div").gmap3({
        marker:{
            id:"to",
            latLng:event.latLng,
            options:{
                draggable:true,
                icon:new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_greenB" + ".png")
            },
            tag: "to",
            events: {
                dragend:ihavedraggedcompletely
            },
            callback: function(marker){
            //updateMarker(marker, isM1);
            }
        }
    });
    from = $("#mymap_div").gmap3({
        get:{
            id:"from"
        }
    });
to = $("#mymap_div").gmap3({
    get:{
        id:"to"
    }
});
updateDirections("mymap_div",from,to);
}

function clickme(marker, event, context)
{
    var map = $(this).gmap3("get");
    infowindow = $(this).gmap3({
        get:{
            name:"infowindow"
        }
    });
if (infowindow)
{
    infowindow.open(map, marker);
    infowindow.setContent(context.data);
}
else
{
    $(this).gmap3({
        infowindow:
        {
            anchor:marker,
            options:{
                content: context.data
                }
        }
    });
}
}

//Function that will initialize a standard map object with just id and width and height
function initializeme(width,height,id)
{
    map = $("#"+id).width(width).height(height).gmap3();
    return map;
}

//Function that will generate an advanced map that may support options events and also css style
function generateme(id,setmydimensions,width,height,css,setevents,myevents,setoptions,options,setmarkers,marker_values,marker_options,marker_events)
{
    mymap = $('#'+id);
    if(setmydimensions === 1)
    {
        $(mymap).width(width).height(height).show();
    }
        
    if(setevents === 1)
    {
        $(mymap).gmap3({
            map:{
                events:myevents
            }
        });
}
        
if(setoptions === 1)
{
    if(setmarkers === 1)
        $(mymap).show().gmap3({
            map:{
                options:options
            },
            marker:{
                values:marker_values,
                options:marker_options,
                events:marker_events
            }
        });
else
    $(mymap).show().gmap3({
        map:{
            options:options
        }
    });
}
else
{
    if(setmarkers === 1)
        $(mymap).show().gmap3({
            map:{
                options:options
            },
            marker:{
                values:marker_values,
                options:marker_options,
                events:marker_events
            }
        });
else
    $(mymap).show().gmap3();
}
        
if(css !== "")
    $(mymap).css(css);
       
return $(mymap);
}

//Function that will be used to add a marker with events and options dynamicly responding to an event
function addmarker(id,marker_values,marker_options,marker_events)
{
    if(marker_events)
        newmarker = $("#"+id).gmap3({
            marker:{
                values:marker_values,
                options:marker_options,
                events:marker_events
            }
        });
else
    newmarker = $("#"+id).gmap3({
        marker:{
            values:marker_values,
            options:marker_options,
            events:{
                mouseover:mouseoverme,
                mouseout:mouseoutme,
                dragend:ihavebeendragged
            }
        }
    });        
return newmarker;
}

//Function that will handle the dragend event of the marker to that will set the detination of routing operation
function ihavedraggedcompletely(marker)
{
    mm = $("#mymap_div").gmap3({
        get:{
            id:"from"
        }
    });
updateDirections("mymap_div",marker,mm);
}

//Function that will be used to handle the dragend event of any marker else than the to marker
function ihavebeendragged(marker,event,context)
{
    fullposition = getmyposition(event);
    $("input[name=longitude]").val(fullposition[0]);
    $("input[name=lattitude]").val(fullposition[1]);
    mm = $("#mymap_div").gmap3({
        get:{
            id:"to"
        }
    });
try
{
    updateDirections("mymap_div",marker,mm);
}
catch(Ex)
{
}
}

//Function that will be used to trace the route between a marker origin and a marker destination
function updateDirections(id,mysource,mydestination){
    if (!(mysource && mydestination)){
        return;
    }
    setTimeout(function(){
        console.log("");
    },6000);
    $("#"+id).gmap3({
        getroute:{
            options:{
                origin:mysource.getPosition(),
                destination:mydestination.getPosition(),
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            },
            callback: function(results){
                if (!results) {
                    console.log("error");
                    return;
                }
                rend = $("#"+id).gmap3({
                    get:"directionsrenderer"
                });
                if(rend)
                    $("#"+id).gmap3({
                        get:"directionsrenderer"
                    }).setDirections(results);
                else
                {
                    $("#"+id).gmap3({
                        directionsrenderer:{
                            divId:"directions",
                            options:{
                                directions:results,
                                preserveViewport: true,
                                markerOptions:{
                                    visible: false
                                }
                            } 
                        }
                    });
                }
            }
        }
    });
}