/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function ihavebeencreatedclickme(marker,event,context,Question)
          {
              newname = prompt(Question);
              context.data=newname;
              $("#marker1").attr({placeholder:newname});
          }
          
//Function that handle the click event on the map

function altermarker()
    {
        newname[0]=$("input[name=en-point]");
        newname[1]=$("input[name=fr-point]");
        newname[2]=$("input[name=ar-point]");
        try
        {
            marker = $("#mylayer").data("marker");
            event = $("#mylayer").data("event");
            context = $("#mylayer").data("context");
        }
        catch(Ex)
        {
            try
            {
                event = $("#mylayer").data("event");
                context = $("#mylayer").data("context");
            }
            catch(Ex)
            {
                try{context = $("#mylayer").data("context");}
                catch(Ex2){}
            }
        }            
        
        if(newname[0]===null && newname[1]===null && newname[0]===null){return;}
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
              newname = prompt(QuestionForChangingPoint);
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
    
function myprompt(marker,event,context,Question)
    {
        $("#mylayer").data("marker",marker);
        $("#mylayer").data("event",event);
        $("#mylayer").data("context",context);
        $("#mylayer").show();
        $("#myinnerlayer").show();
    }
 
 /*$("#mymap_div").gmap3({
    marker:{
      id:"from-" + ttt,
      latLng:event.latLng,
      data:"default",
      options:{
        draggable:false,
        icon:new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_greenA" + ".png"),
      },
      tag: "from",
      events: {
          click:function(marker,event,context)
          {
              /*newname = prompt(QuestionForChangingPoint);
              context.data=newname;
              $("#marker1").attr({placeholder:newname});*/
          /*},mouseover:mouseoverme,mouseout:mouseoutme,dragend:ihavebeendragged,rightclick:function(marker,event,context){rightclickmarker(marker,event,context,DeletePointQuestion)}
      },
      callback: function(marker){
        //updateMarker(marker, isM1);
        setTimeout(function(){$("#loader_img").hide().attr('src','');mm = $("#mymap_div").gmap3({get:{id:"to"}});
         try
         {
         //updateDirections("mymap_div",marker,mm);
         }
         catch(Ex)
         {
         }},6000);
      }
    }
  });*/
  //fullposition = getmyposition(event);
  //$("input[name=longitude]").val(fullposition[0]);
  //$("input[name=lattitude]").val(fullposition[1]);
  
function clickmee(marker,event,context,QuestionForNewPoint,QuestionForChangingPoint)
    {
        myprompt(marker,event,context,QuestionForNewPoint);
    }
    
    
    //Original functions------------------------------------------------------------------------------------------//
    
    function clickmee(marker,event,context,QuestionForNewPoint,QuestionForChangingPoint)
    {
        if(event.clicks == 2) return;
        newname = prompt(QuestionForNewPoint);
        if((newname)===null){return;}
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
              newname = prompt(QuestionForChangingPoint);
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
    
    