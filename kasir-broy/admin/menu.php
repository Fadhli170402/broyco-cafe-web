<?php include "../functions.php";
include "addmenu.php";
include "additem.php";
include "deletemenu.php";
if (
  !isset($_SESSION["uid"]) &&
  !isset($_SESSION["username"]) &&
  isset($_SESSION["user_level"])
) {
  header("Location: login.php");
}
if ($_SESSION["user_level"] != "admin") {
  header("Location: login.php");
}
?>
    
<?php include "header.php"; ?> 

<div class="col-12 col-md-12 p-3 p-md-5 bg-white border border-white text-center"> <i class="fas fa-utensils fa-4x"></i> <h1><strong>Menu Cafe</strong></h1> <p>Food and Drink Menu cafe.</p> <button class="btn btn-lg btn-dark btn-sm float-center rounded-pill" data-toggle="modal" data-target="#addMenuModal">Add Group</button><br/> <div class="card-body row"> <?php
$menuQuery = "SELECT * FROM tbl_menu";
if ($menuResult = $sqlconnection->query($menuQuery)) {
  if ($menuResult->num_rows == 0) {
    echo "<center><label>Tidak ada kategori saat ini.</label></center>";
  }
  while (
    $menuRow = $menuResult->fetch_array(MYSQLI_ASSOC)
  ) { ?> <div class="col-12 col-md-6 card mb-3 border-white"><div class="card-header bg-dark text-white"><?php echo $menuRow[
   "menuName"
 ]; ?> <button title="delete this gorup menu" class="btn btn-danger btn-sm float-end" data-toggle="modal" data-target="#deleteModal" data-category="<?php echo $menuRow[
   "menuName"
 ]; ?>" data-menuid="<?php echo $menuRow[
  "menuID"
]; ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/> </svg> </button><button title="add new menu on this group" class="btn btn-primary btn-sm float-end" data-toggle="modal" data-target="#addItemModal" data-category="<?php echo $menuRow[
  "menuName"
]; ?>" data-menuid="<?php echo $menuRow[
  "menuID"
]; ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16"> <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/> </svg> </button></div><div class="card-body"><table class="table table-responsive table-lg shadow" id="dataTable" width="100%" cellspacing="0"><tr class="bg-warning"><td>#</td><td>Menu's</td><td>Price</td><td></td></tr><?php
$menuItemQuery =
  "SELECT * FROM tbl_menuitem WHERE menuID = " . $menuRow["menuID"];
if ($menuItemResult = $sqlconnection->query($menuItemQuery)) {
  if ($menuItemResult->num_rows == 0) {
    echo "<td colspan='4' class='text-center'>No item in this category.</td>";
  }
  $itemno = 1;
  while (
    $menuItemRow = $menuItemResult->fetch_array(MYSQLI_ASSOC)
  ) { ?> <tr> <td><?php echo $itemno++; ?></td> <td><?php echo $menuItemRow[
  "menuItemName"
]; ?></td> <td><?php echo $menuItemRow[
  "price"
]; ?></td> <td> <a class="text-success" title="edit menu" href="#editItemModal" data-toggle="modal" data-itemname="<?php echo $menuItemRow[
  "menuItemName"
]; ?>" data-itemprice="<?php echo $menuItemRow[
  "price"
]; ?>" data-menuid="<?php echo $menuRow[
  "menuID"
]; ?>" data-itemid="<?php echo $menuItemRow[
  "itemID"
]; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16"><path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/></svg></a> <a title="delete menu" class="text-danger" href="deleteitem.php?itemID=<?php echo $menuItemRow[
  "itemID"
]; ?>&menuID=<?php echo $menuRow[
  "menuID"
]; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg></a> </td></tr> <?php }
} else {
  die("Something wrong happened");
}
?> </table> </div> </div> <?php }
} else {
  die("Something wrong happened");
}
?> 
</div>
</div>
</div>
<div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="addMenuModalLabel">Add Group</h5> <button type="button" class="close btn btn-dark text-white" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><div class="modal-body"><form id="addmenuform" method="POST"><div class="form-group"> <label class="col-form-label">Group:</label> <input type="text" required="required" class="form-control" name="menuname" placeholder="Ex Food ,Drink Etc" ></div></form></div><div class="modal-footer"> <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> <button type="submit" form="addmenuform" class="btn btn-success" name="addmenu">Add</button></div></div></div></div><div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="addItemModalLabel">Add Menu</h5> <button type="button" class="close btn-dark text-white btn" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><div class="modal-body"><form id="additemform" method="POST"><div class="form-group"> <label class="col-form-label">Menu Name</label> <input type="text" required="required" class="form-control" name="itemName" placeholder="input name ex: burger,pizza" ></div><div class="form-group"> <label class="col-form-label">Sell Price</label> <input type="number" required="required" class="form-control" name="itemPrice" placeholder="Input sell price" > <input type="hidden" name="menuID" id="menuid"></div></form></div><div class="modal-footer"> <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> <button type="submit" form="additemform" class="btn btn-success" name="addItem">Add</button></div></div></div></div><div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="addItemModalLabel">Edit Menu</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><div class="modal-body"><form id="edititemform" action="edititem.php" method="POST"><div class="form-group"> <label class="col-form-label">Nama menu</label> <input type="text" required="required" id="itemname" class="form-control" name="itemName" placeholder="Misal nasi goreng" ></div><div class="form-group"> <label class="col-form-label">Harga Jual</label> <input type="text" required="required" id="itemprice" class="form-control" name="itemPrice" placeholder="Masukan Harga Jual" > <input type="hidden" name="menuID" id="menuid"> <input type="hidden" name="itemID" id="itemid"></div></form></div><div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> <button type="submit" form="edititemform" class="btn btn-primary" name="btnedit">Edit</button></div></div></div></div><div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="deleteModalLabel">Anda yakin menghapus kategori ini?</h5> <button class="close" type="button" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button></div><div class="modal-body">Penghapusan kategori akan <strong>menghapus</strong> seluruh data menu pada kategori.</div><div class="modal-footer"><form id="deletemenuform" method="POST"> <input type="hidden" name="menuID" id="menuid"></form> <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> <button type="submit" form="deletemenuform" class="btn btn-danger" name="deletemenu">Delete</button></div></div></div></div> <script src="vendor/jquery/jquery.min.js"></script> <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> <script src="vendor/jquery-easing/jquery.easing.min.js"></script> <script src="js/sb-admin.min.js"></script> <script>$('#addItemModal').on('show.bs.modal',function(event){var button=$(event.relatedTarget);var id=button.data('menuid');var category=button.data('category');var modal=$(this);modal.find('.modal-title').text('Add new menu ('+category+')');modal.find('.modal-body #menuid').val(id);});$('#editItemModal').on('show.bs.modal',function(event){var button=$(event.relatedTarget);var menuid=button.data('menuid');var itemid=button.data('itemid');var itemname=button.data('itemname');var itemprice=button.data('itemprice');var modal=$(this);modal.find('.modal-body #menuid').val(menuid);modal.find('.modal-body #itemid').val(itemid);modal.find('.modal-body #itemname').val(itemname);modal.find('.modal-body #itemprice').val(itemprice);});$('#deleteModal').on('show.bs.modal',function(event){var button=$(event.relatedTarget);var id=button.data('menuid');var category=button.data('category');var modal=$(this);modal.find('.modal-body').html('Select "Delete" below will delete all <strong>'+category+' </strong> item or menu in this category.');modal.find('.modal-footer #menuid').val(id);});</script> <script type="text/javascript">window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).hide();});},1000);</script> <?php include "footer.php"; ?>
