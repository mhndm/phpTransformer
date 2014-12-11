        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language={MiniLang}&Ssf"></script>
        <script type="text/javascript" src="Programs/mygmap3/admin/gmap3/gmap3.min.js"></script>
        <script type="text/javascript" src="Programs/mygmap3/admin/js/myfunctions.js?v=1"></script>
        <script type="text/javascript">
            $(document).ready(
                    function()
                        {
                            
                            //initializeme("800px","600px","mymap_div");
                            generateme("mymap_div",1,"800px","600px","",1,{click:function(marker,event,context){clickmee(marker,event,context,"{QuestionForNewName}","{QuestionForChangingName}","{Lang}","{DeletePointQuestion}");}},1,{zoom:10,center:{point_center},scrollwheel:false,streetViewControl: true});
                            
                            $("input[name=save]").click(function(){save("{saved}","{Failed}","{Lang}");});
                            
                            $("#mylayer").click(emptymyprompt);
                            $("#terrain").click(function()
                                {
                                    $("#mymap_div").gmap3({map:{options:{mapTypeId:google.maps.MapTypeId.TERRAIN}}});
                                });
                            $("#maps").click(function()
                                {
                                    $("#mymap_div").gmap3({map:{options:{mapTypeId:google.maps.MapTypeId.ROADMAP}}});
                                });
                            $("#satellite").click(function()
                                {
                                    $("#mymap_div").gmap3({map:{options:{mapTypeId:google.maps.MapTypeId.SATELLITE}}});
                                });
                            $("#hybrid").click(function()
                                {
                                    $("#mymap_div").gmap3({map:{options:{mapTypeId:google.maps.MapTypeId.HYBRID}}});
                                });
                            $("input[name=save-point]").click(altermarker);
                            {all_points}
                        }
                    );
        </script>
        <style type="text/css">
            .gm-style
            {
                font-family: Tahoma !important;
            }
        </style>