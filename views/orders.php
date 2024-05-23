<?php
$title = "Orders page";
$page = "orders";
include 'views/layouts/header.php';
?>

<div class="card shadow">
    <div class="card-header py-3">
        <div class="row">
            <h4 class="text-primary m-0 mb-2 mb-lg-0 fw-bold col-lg-4">Đơn hàng</h4>
            <div class="dataTables_filter col-lg-4" id="dataTable_filter">
                <label class="form-label w-100">
                    <input type="search" class="form-control form-control-sm w-100" aria-controls="dataTable" placeholder="Nhập mã đơn hàng">
                </label>
            </div>
            <div class="col-lg-4 text-lg-end text-nowrap">
                <select class="form-select form-select-sm">
                    <option selected>Tất cả</option>
                    <option value="1">Chờ xác nhận</option>
                    <option value="2">Chờ lấy hàng</option>
                    <option value="3">Đang giao</option>
                    <option value="4">Đã giao</option>
                    <option value="5">Đơn hủy</option>
                    <option value="6">Đang trả hàng</option>
                    <option value="7">Đã trả hàng</option>
                    <option value="8">Thất lạc</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table my-0 table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Số SP</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền (vnđ)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Airi Satou</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>33</td>
                        <td>2008/11/28</td>
                        <td>$162,700</td>
                    </tr>
                    <tr>
                        <td>Angelica Ramos</td>
                        <td>Chief Executive Officer(CEO)</td>
                        <td>London</td>
                        <td>47</td>
                        <td>2009/10/09<br></td>
                        <td>$1,200,000</td>
                    </tr>
                    <tr>
                        <td>Ashton Cox</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>66</td>
                        <td>2009/01/12<br></td>
                        <td>$86,000</td>
                    </tr>
                    <tr>
                        <td>Bradley Greer</td>
                        <td>Software Engineer</td>
                        <td>London</td>
                        <td>41</td>
                        <td>2012/10/13<br></td>
                        <td>$132,000</td>
                    </tr>
                    <tr>
                        <td>Brenden Wagner</td>
                        <td>Software Engineer</td>
                        <td>San Francisco</td>
                        <td>28</td>
                        <td>2011/06/07<br></td>
                        <td>$206,850</td>
                    </tr>
                    <tr>
                        <td>Brielle Williamson</td>
                        <td>Integration Specialist</td>
                        <td>New York</td>
                        <td>61</td>
                        <td>2012/12/02<br></td>
                        <td>$372,000</td>
                    </tr>
                    <tr>
                        <td>Bruno Nash<br></td>
                        <td>Software Engineer</td>
                        <td>London</td>
                        <td>38</td>
                        <td>2011/05/03<br></td>
                        <td>$163,500</td>
                    </tr>
                    <tr>
                        <td>Caesar Vance</td>
                        <td>Pre-Sales Support</td>
                        <td>New York</td>
                        <td>21</td>
                        <td>2011/12/12<br></td>
                        <td>$106,450</td>
                    </tr>
                    <tr>
                        <td>Cara Stevens</td>
                        <td>Sales Assistant</td>
                        <td>New York</td>
                        <td>46</td>
                        <td>2011/12/06<br></td>
                        <td>$145,600</td>
                    </tr>
                    <tr>
                        <td>Cedric Kelly</td>
                        <td>Senior JavaScript Developer</td>
                        <td>Edinburgh</td>
                        <td>22</td>
                        <td>2012/03/29<br></td>
                        <td>$433,060</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6 align-self-center">
                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Đơn hàng 1 đến 10 trong 27</p>
            </div>
            <div class="col-md-6">
                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>