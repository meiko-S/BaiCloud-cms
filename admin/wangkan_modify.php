<?php
include ("admin.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/3/ckeditor/ckeditor.js"></script>
<script language = "JavaScript">
function CheckForm(){
if (document.myform.bigclassid.value==""){
    alert("请选择网刊类别！");
	document.myform.bigclassid.focus();
	return false;
  }	 	  
if (document.myform.title.value==""){
    alert("网刊名称不能为空！");
	document.myform.title.focus();
	return false;
  }
}    
</script>
</head>
<body>
<?php
checkadminisdo("wangkan");
$page = isset($_GET['page'])?$_GET['page']:1;
checkid($page);
$id = isset($_GET['id'])?$_GET['id']:0;
checkid($id,1);
?>
<div class="admintitle">修改网刊信息</div>
<?php
$sql="select * from zzcms_wangkan where id='$id'";
$rs=query($sql);
$row=fetch_array($rs);
?>
<form action="wangkan_save.php?action=modify" method="post" name="myform"  id="myform" onSubmit="return CheckForm();">     
  <table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr> 
      <td align="right" class="border">所属类别：</td>
      <td class="border"> 
	   <?php
		$sqln = "select bigclassid,bigclassname from zzcms_wangkanclass order by xuhao asc";
	    $rsn=query($sqln);
        $rown=num_rows($rsn);
		if (!$rown){
			echo "请先添加栏目。";
		}else{
		?>
		<select name="bigclassid" id="bigclassid">
                <option value="" selected="selected">请选择类别</option>
                <?php
		while($rown= fetch_array($rsn)){
			?>
                <option value="<?php echo $rown["bigclassid"]?>" <?php if ($rown["bigclassid"]==$row["bigclassid"]) { echo "selected";}?>><?php echo $rown["bigclassname"]?></option>
                <?php
		  }
		  ?>
              </select>
		<?php
		}
		?>       </td>
    </tr>
    <tr> 
      <td width="100" align="right" class="border">名称：</td>
      <td class="border"> <input name="title" type="text" id="title22" value="<?php echo $row["title"]?>" size="50" maxlength="255"></td>
    </tr>
    <tr> 
      <td width="100" align="right" class="border">内容：</td>
      <td class="border"><textarea name="content" id="content" ><?php echo stripfxg($row["content"])?></textarea> 
       	<script type="text/javascript">CKEDITOR.replace('content');	</script>
        <input name="id" type="hidden" id="id" value="<?php echo $row["id"]?>">
        <input name="page" type="hidden" id="page" value="<?php $page?>"></td>
    </tr>
    <tr> 
      <td align="right" class="border">审核：</td>
      <td class="border"><input name="passed" type="checkbox" id="passed" value="1" <?php if ($row["passed"]==1){ echo "checked";}?>>
        （选中为通过审核）</td>
    </tr>
    <tr> 
      <td align="right" class="border">置顶值：</td>
      <td class="border"> <input name="elite" type="text" id="url" value="<?php echo $row["elite"]?>" maxlength="3">
        (0-255之间的数字，数值大的排在前面) </td>
    </tr>
    <tr> 
      <td align="right" class="border">&nbsp;</td>
      <td class="border"><input name="Submit" type="submit" id="Submit" value="修 改" ></td>
    </tr>
  </table>
</form>
	  
</body>
</html>