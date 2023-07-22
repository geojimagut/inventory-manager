<p class="page-title">INVENTORY</p>
<div class="page-panel">
<div class="home-page">
    <div class="table-side">
        <table id="tbl"cellspacing="0">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Stauts</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kitchen Appliances</td>
                    <td>Active</td>
                    <td>
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash"></i>
                    </td>
                </tr>
                <tr>
                    <td>Kitchen Appliances</td>
                    <td>Active</td>
                    <td>
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="add-side">
        <span class="page-title">ADD CATEGORY</span>
        <form action="">
            <input type="text"placeholder="Item Name">
            <input type="number"placeholder="Quantity">
            <input type="number"placeholder="Total Price">
            <select name="" id="">
                <option value=""selected="false"disabled>Supplier</option>
                <option value="">Supplier 1</option>
                <option value="">Supplier 2</option>
            </select>
            <select name="" id="">
                <option value=""selected="false"disabled>Category</option>
                <option value="">Category 1</option>
                <option value="">Category 2</option>
            </select>
            <button>SAVE</button>
        </form>
    </div>
</div>
</div>
<?php include('footer.php');?>