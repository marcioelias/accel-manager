<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Panel title</h3>
    </div>
    <div class="card-body">
        <div class="list-group">
            <li class="list-group-item">item 1 
                <button class="btn btn-sm btn-danger pull-right" id="btnEdit1"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <button class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
            </li>
            <li class="list-group-item">item 2 
                <button class="btn btn-sm btn-danger pull-right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <button class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></li>
            <li class="list-group-item">item 2 
                <button class="btn btn-sm btn-danger pull-right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <button class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
            </li>
            <li class="list-group-item">item 3 
                <button class="btn btn-sm btn-danger pull-right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <button class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
            </li>
            <li class="list-group-item">item 4 
                <button class="btn btn-sm btn-danger pull-right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <button class="btn btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
            </li>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col col-md-11 col-lg-11 col-xg-11">
                <input type="text" class="form-control" id="editField">
            </div>
            <div class="col col-md-1 col-lg-1 col-xg-1">
            <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button> 
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnEdit1').click(function() {
        document.getElementById('editField').val('Item 1');
    });
</script>