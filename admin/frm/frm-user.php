<form method="POST" class="upl">
    <div class="frm">
        <div class="header">
            <p><i class="fa-solid fa-user-plus"></i> Add New User</p>
        </div>
        <div class="body">
            <div class="box">
                <div class="left">
                    <h6>ID :</h6>
                </div>
                <div class="right">
                    <input type="txt" class="form-control" id="id" name="id" readonly>
                    <input type="hidden" class="form-control" id="edit-id" name="edit-id" value="0">
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <h6>First Name :</h6>
                </div>
                <div class="right">
                    <input type="txt" class="form-control" id="first-name" name="first-name">
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <h6>Last Name :</h6>
                </div>
                <div class="right">
                    <input type="txt" class="form-control" id="last-name" name="last-name">
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <h6>Gender :</h6>
                </div>
                <div class="right">
                    <select class="form-select" id="gender" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <h6>Date Join :</h6>
                </div>
                <div class="right">
                    <input type="txt" class="form-control" id="date-join" name="date-join">
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <h6>Email :</h6>
                </div>
                <div class="right">
                    <input type="txt" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <h6>Password :</h6>
                </div>
                <div class="right">
                    <input type="txt" class="form-control" id="pass" name="pass">
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <h6>Type :</h6>
                </div>
                <div class="right">
                    <select class="form-select" id="type" name="type">
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                        <option value="Stock Controller">Stock Controller</option>
                        <option value="Saler">Saler</option>
                    </select>
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <h6>Status :</h6>
                </div>
                <div class="right">
                    <select class="form-select" id="status" name="status">
                        <option value="1">1</option>
                        <option value="0">0</option>
                    </select>
                </div>
            </div>
            <div class="box">
                <div class="left"></div>
                <div class="right">
                    <button type="button" class="btn btn-outline-primary" id="add">Add</button>
                    <button type="button" class="btn btn-outline-danger" id="cancel">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
