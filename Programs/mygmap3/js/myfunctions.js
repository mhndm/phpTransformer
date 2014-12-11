/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var m1,m2,m3,m4;

//Function that send the balloon datas to the file that will save them
function save()
    {
        var longitude,lattitude;
        longitude = $("input[name=longitude]").val();
        lattitude = $("input[name=lattitude]").val();
        homename = $("#marker1").attr('placeholder');
        //$("#save_frm").attr("action","search.php");
        var request = $.ajax({
            url: "Programs/mygmap3/admin/save.php",
            type: "POST",
            data: {"longi":longitude,"latti":lattitude,"homename":homename}
        });
        request.done(function( msg ) {
            alert("Your point has been saved");
        });
 
        request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
        //$("#save_frm").submit();
    }
    
//Function that handle a mouse over on a marker
function mouseoverme(marker, event, context)
    {
       var map = $(this).gmap3("get"),
       infowindow = $(this).gmap3({get:{name:"infowindow"}});
       if (infowindow)
             {
                    if(context.data)
                        {
                            infowindow.open(map, marker);
                            infowindow.setContent(context.data);
                        }
             }
       else
             {
                 if(context.data)
                    {
                        $(this).gmap3({
                                       infowindow:
                                               {
                                                     anchor:marker,
                                                     options:{content: context.data}
                                                }
                                  });
                    }
              }
    }

//Function that handle the mouse out event of the marker
function mouseoutme()
     {
           var infowindow = $(this).gmap3({get:{name:"infowindow"}});
           if (infowindow)
                {
                     infowindow.close();
                }
     }

function ihavebeencreatedclickme(marker,event,context)
          {
              newname = prompt("Give your marker a new name");
              context.data=newname;
              $("#marker1").attr({placeholder:newname});
          }
          
//Function that handle the click event on the map
function clickmee(marker,event,context)
    {
        if(event.clicks == 2) return;
        newname = prompt("Give your marker a new name");
        $("#loader_img").show().attr('src','Programs/mygmap3/admin/images/ajax-loader.gif');
        $("#marker1").attr({placeholder:newname});
        var clear = {tag:"from"};
        $("#mymap_div").gmap3({clear:clear});
        $("#mymap_div").gmap3({
    marker:{
      id:"from",
      latLng:event.latLng,
      data:newname,
      options:{
        draggable:true,
        icon:new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_greenA" + ".png"),
      },
      tag: "from",
      events: {
          click:function(marker,event,context)
          {
              newname = prompt("Give your marker a new name");
              context.data=newname;
              $("#marker1").attr({placeholder:newname});
          },mouseover:mouseoverme,mouseout:mouseoutme,dragend:ihavebeendragged
      },
      callback: function(marker){
        //updateMarker(marker, isM1);
        setTimeout(function(){$("#loader_img").hide().attr('src','');mm = $("#mymap_div").gmap3({get:{id:"to"}});
         try
         {
         updateDirections("mymap_div",marker,mm);
         }
         catch(Ex)
         {
         }},6000);
      }
    }
  });
  fullposition = getmyposition(event);
  $("input[name=longitude]").val(fullposition[0]);
  $("input[name=lattitude]").val(fullposition[1]);
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
        var currentfrom = $("input[name=longitude]").val();
        if(currentfrom == "")
            {
                alert("Please choose Your source !")
                return;
            }
        var clear = {tag:"to"};
        $("#mymap_div").gmap3({clear:clear});
        $("#mymap_div").gmap3({
    marker:{
      id:"to",
      latLng:event.latLng,
      options:{
        draggable:true,
        icon:new google.maps.MarkerImage("Programs/mygmap3/images/destination.png")
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
    from = $("#mymap_div").gmap3({get:{id:$("input[name=longitude]").val()}});
    to = $("#mymap_div").gmap3({get:{id:"to"}});
    updateDirections("mymap_div",from,to);
    }

function clickme(marker, event, context)
    {
       var map = $(this).gmap3("get");
       infowindow = $(this).gmap3({get:{name:"infowindow"}});
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
                                                     options:{content: context.data}
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
                $(mymap).gmap3({map:{events:myevents}});
            }
        
        if(setoptions === 1)
            {
                if(setmarkers === 1)
                    $(mymap).show().gmap3({map:{options:options},marker:{values:marker_values,options:marker_options,events:marker_events}});
                else
                    $(mymap).show().gmap3({map:{options:options}});
            }
        else
            {
                if(setmarkers === 1)
                    $(mymap).show().gmap3({map:{options:options},marker:{values:marker_values,options:marker_options,events:marker_events}});
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
            newmarker = $("#"+id).gmap3({marker:{values:marker_values,options:marker_options,events:marker_events}});
        else
            newmarker = $("#"+id).gmap3({marker:{values:marker_values,options:marker_options,events:{mouseover:mouseoverme,mouseout:mouseoutme,dragend:ihavebeendragged}}});        
        return newmarker;
    }

//Function that will handle to give the marker a tag that will tell the map from which to whic point must paint direction
function specifysource(marker,event,context)
{
    $("input[name=longitude]").val(context.id);
    markers = $("#mymap_div").gmap3({get:{tag:"from",full:true,all:true}});
    $.each(markers, function(i, markeer){
      markeer.object.setIcon("");
    });
    marker.setIcon("Programs/mygmap3/images/source.png");
    mm = $("#mymap_div").gmap3({get:{id:"to"}});
    console.log(mm);
    console.log(marker);
    updateDirections("mymap_div",marker,mm);
}
//Function that will handle the dragend event of the marker to that will set the detination of routing operation
function ihavedraggedcompletely(marker)
    {
        mm = $("#mymap_div").gmap3({get:{id:$("input[name=longitude]").val()}});
         updateDirections("mymap_div",marker,mm);
    }

//Function that will be used to handle the dragend event of any marker else than the to marker
function ihavebeendragged(marker,event,context)
    {
        fullposition = getmyposition(event);
        $("input[name=longitude]").val(fullposition[0]);
        $("input[name=lattitude]").val(fullposition[1]);
         mm = $("#mymap_div").gmap3({get:{id:"to"}});
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
  if (!(mysource && mydestination)){return;}
  $("#"+id).gmap3({
    getroute:{
      options:{
        origin:mysource.getPosition(),
        destination:mydestination.getPosition(),
        travelMode: google.maps.DirectionsTravelMode.DRIVING
      },
      callback: function(results){
        if (!results) {console.log("error");return;}
        rend = $("#"+id).gmap3({get:"directionsrenderer"});
        if(rend)
            $("#"+id).gmap3({get:"directionsrenderer"}).setDirections(results);
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