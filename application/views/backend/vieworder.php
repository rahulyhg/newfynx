<div class="row">
<div class="col s12">
<table class="ordercard-table1"></table>
<div class="row">
<div class="drawchintantable padding">
    </div>
</div>
<?php $this->chintantable->createpagination();?>
<!-- <div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url('site/createorder'); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div> -->
</div>
</div>
<script>
function drawtable(resultrow) {

    var orderitems = "";
    for(var i=0;i<resultrow.orderproduct.length;i++) {
        var row = resultrow.orderproduct[i];
        if(row.checkcustom != ''){
            var custom=JSON.parse(row.checkcustom);
            var class1 = "";
            var class2 = "";
            if(custom.custom[0].text == "" && custom.custom[1].text == "" && custom.image1.image == "")
            {
                    class1 = "invisible";
                    console.log(custom);
            }
            if(custom.custom[2].text == "" && custom.custom[3].text == "" && custom.image1.image1 == "")
            {
                    class2 = "invisible";
                    console.log(custom);
            }
            
             orderitems += "<tr class=\"repeat\"> <td>"+row.productname+" <\/td><td>"+0+" <\/td><td>"+row.price+" <\/td><td>"+row.quantity+" <\/td><td>"+row.finalprice+" <\/td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 "+class1+" z-depth-0 less-pad tooltipped' data-position='top' data-delay='50' data-tooltip='Front' href='http://104.197.40.132:81/Image/myFynx?url=homefront/"+row.orderitemid+"'><i class='material-icons propericon'>print</i></a></td><td><a class='deep-orange "+class2+" btn btn-primary btn-xs waves-effect waves-light z-depth-0 less-pad tooltipped'  data-position='top' data-delay='50' data-tooltip='Back' href='http://104.197.40.132:81/Image/myFynx?url=homeback/"+row.orderitemid+"' ><i class='material-icons propericon'>print</i></a></td><\/tr>";
        }
        else{
         
            orderitems += "<tr class=\"repeat\"> <td>"+row.productname+" <\/td><td><a href='<?php echo base_url('uploads').'/'; ?>" + row.image + "' target='_blank' > "+row.productname+" </a><\/td><td>"+row.price+" <\/td><td>"+row.quantity+" <\/td><td>"+row.finalprice+" <\/td><\/tr>";
        }

    }

    setTimeout(function() {
      $(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
  });
    },100);

   var strVar="";
strVar += "<div class=\"ordercard\"> <table  class=\"ordercard-table1\"><thead> <tr> <th>Id </th> <th>Name </th> <th>Email </th> <th>Order Status</th><th>Timestamp</th><th>Action</th> </tr></thead><tr> <td> <span class=\"id\">"+resultrow.id+"<\/span> <\/td><td> <span class=\"name\">"+resultrow.firstname+" " + resultrow.lastname+"<\/span> <\/td><td> <span class=\"email\">"+resultrow.email+"<\/span> <\/td><td> <span class=\"status\">"+resultrow.orderstatusname+"<\/span> <\/td><td> <span class=\"timestamp\">"+resultrow.timestamp+"<\/span><\/td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editorder?id=');?>"+resultrow.id+"'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deleteorder?id='); ?>"+resultrow.id+"'><i class='material-icons propericon'>delete</i></a><a class='btn btn-danger btn-xs waves-effect waves-light green pad10 z-depth-0 less-pad' target='_blank' href='<?php echo site_url('site/printorderinvoice?id='); ?>"+resultrow.id+"'><i class='material-icons print'>print</i></a></td><\/tr><\/table> <table  class=\"ordercard-table2\"> <thead> <tr> <th>Product <\/th><th>Design <\/th> <th>Amount <\/th> <th>Quantity <\/th> <th>Total Amount <\/th> <\/tr><\/thead> <tbody>"+orderitems+" <\/tbody> <\/table><\/div>";


return strVar;

}
generateorder("<?php echo $base_url;?>");
</script>
