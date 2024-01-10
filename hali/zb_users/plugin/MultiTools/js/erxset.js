/*
For: MultiTools多功能贴边工具栏[ZBLOG-PHP插件]
Author: 尔今
Author Email: erx@qq.com
Author URL: http://www.yiwuku.com/
*/

$(function(){
    //erx:Items
    var asis = [], asval = $("#int_as").val();
    asis = asval.split("|");
    for(var i=0;i<asis.length;i++){
        $(".asi label:eq("+i+") input").val(asis[i]);
    }
    $(".asi label input").each(function(){
        var inm = $(this).attr("name");
        if($(this).val() == inm){
            $(this).attr("checked", true);
        }
    });
    $(".asi label").click(function(){
        var cit = $(this).children("input"),
            inm = cit.attr("name"),
            seat = $(this).index();
        if(cit.is(":checked")){
            cit.val(inm);
            asis.splice(seat,1,inm);
        }else{
            cit.val("0");
            asis.splice(seat,1,0);
        }
        $("#int_as").val(asis.join("|"));
    });
    //erx:ColorSelect
    $(".colorint").each(function() {
        $(this).append('<i></i>');
    });
    $(".colorint i").each(function() {
        var cv = $(this).prev("input").val();
        if(cv!=""){
            $(this).css('background',cv);
        }
    });
    $('.colorint input').colpick({
        layout:'hex',
        submit:0,
        onChange:function(hsb,hex,rgb,el,bySetColor) {
            $(el).next("i").css('background','#'+hex);
            if(!bySetColor) $(el).val('#'+hex);
        }
    }).keyup(function(){
        $(this).colpickSetColor(this.value);
    });
    //erx:DiyColor
    function DiyColor(){
        var diycolor = $(".diycolor").val().split('|'),
            dcnum = diycolor.length,
            dcli = '';
        for (var i=0;i<dcnum;i++){
            dcli += '<li style="background:'+diycolor[i]+';"></li>';
        }
        $(".clist").html(dcli);
        $(".color-ctrl em").text(dcnum);
    }
    DiyColor();
    $(".diycolor").blur(function(){
        DiyColor();
    });
    var xycsc = 0, $e = $(".color-disk");
    $(".color-ctrl .copy").click(function(){
        if($e.val() == ''){
            $e.attr('placeholder', '请先取色');
        }else{
            $e.select();
            document.execCommand("Copy");
        }
    });
    $(".color-ctrl .add").click(function(){
        var v = $e.val(),
            c = $(".diycolor").val();
        if(v == ''){
            $e.attr('placeholder', '请先取色');
        }else{
            if((xycsc == 0 && c == "") || c == ""){
                $(".diycolor").val(c+v);
            }else{
                $(".diycolor").val(c+"|"+v);
            }
            xycsc = 1;
            DiyColor();
        }
    });
    zbp.cookie.set("adminsign", 1, 9999);
})

/* erx@qq.com https://app.zblogcn.com/?auth=3ec7ee20-80f2-498a-a5dd-fda19b198194 */

