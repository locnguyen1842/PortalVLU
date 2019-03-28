@extends('admin.master')
@section('title','Thống kê')
@section('breadcrumb')
<div class="cm-flex">
    <div class="cm-breadcrumb-container">
        <ol class="breadcrumb">
            <li class="active">Thống kê - Báo cáo</li>
        </ol>
    </div>
</div>
@endsection
@section('content')
<div class="panel panel-default mt-20">
    <div class="panel-heading">
        <div class="panel-heading">Thống kê - Báo cáo<br>



        </div>
    </div>
    <div class="panel-body">
        <div class="form-group form-horizontal">
            <div class="col-sm-6">
                    <div class="col-sm-12">
                            <div class="col-sm-3">
                                    <label class="control-label">Năm học</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select class="form-control" name="school_year">
                                        <option value="">Chọn năm học</option>
                                        {{-- foreach --}}
                                    </select>
                                    <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">Xác nhận</button>
                                        </span>
                                </div>
                            </div>
                    </div>

            </div>
            <div class="col-sm-6">
            </div>
        </div>
        <div class="form-group col-sm-12 mt-25 mb-5">
            <h2 class="text-center">Số cán bộ, Giảng viên, Nhân viên</h2>
            <span class="help-text text-center">Năm học : 201x - 201x</span>
        </div>

    </div>
    <div class="table-responsive">
            <table class="table table-hover table-bordered statistic-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cán bộ quản lý, Giảng viên, Nhân viên</th>
                        <th>Đơn vị tính</th>
                        <th>Mã số</th>
                        <th>Tổng số</th>
                        <th>Khối ngành I</th>
                        <th>Khối ngành II</th>
                        <th>Khối ngành III</th>
                        <th>Khối ngành IV</th>
                        <th>Khối ngành V</th>
                        <th>Khối ngành VI</th>
                        <th>Khối ngành VII</th>
                    </tr>

                </thead>
                <tbody>
                    <tr class="help-tr">
                        <td></td>
                        <td>A</td>
                        <td>B</td>
                        <td>C</td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="bold">Tổng số</td>
                        <td>người</td>
                        <td>105</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số 1">8</div>
                        </td>

                    </tr>
                    <tr>
                        <td class="left bold">2.1</td>
                        <td class="left bold">Cán bộ quản lý</td>
                        <td>người</td>
                        <td>106</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số 1">8</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td>2.1.1</td>
                        <td class="left">Chia ra</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Hiệu trưởng</td>
                        <td>người</td>
                        <td>107</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số 1">8</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Phó hiệu trưởng</td>
                        <td>người</td>
                        <td>108</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số 1">8</div>
                        </td>
                    </tr>
                    <tr class="disabled">
                        <td></td>
                        <td class="left">Trong đó</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giáo sư</td>
                        <td>người</td>
                        <td>109</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Phó giáo sư</td>
                        <td>người</td>
                        <td>110</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Kiêm nhiệm giảng dạy</td>
                        <td>người</td>
                        <td>111</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td>2.1.2</td>
                        <td class="left">Chia theo trình độ đào tạo</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Đại học</td>
                        <td>người</td>
                        <td>112</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Thạc sĩ</td>
                        <td>người</td>
                        <td>113</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Tiến sĩ và TSKH</td>
                        <td>người</td>
                        <td>114</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Khác</td>
                        <td>người</td>
                        <td>115</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td class="bold left">2.2</td>
                        <td class="bold left">Cán bộ hành chính, nghiệp vụ</td>
                        <td>người</td>
                        <td>116</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td></td>
                        <td class="left">Trong đó</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giáo sư</td>
                        <td>người</td>
                        <td>117</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Phó giáo sư</td>
                        <td>người</td>
                        <td>118</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Kiêm nhiệm giảng dạy</td>
                        <td>người</td>
                        <td>119</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td></td>
                        <td class="left">Chia theo trình độ đào tạo</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Cao đẳng</td>
                        <td>người</td>
                        <td>120</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Đại học</td>
                        <td>người</td>
                        <td>121</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Thạc sĩ</td>
                        <td>người</td>
                        <td>122</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Tiến sĩ và TSKH</td>
                        <td>người</td>
                        <td>123</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Khác</td>
                        <td>người</td>
                        <td>124</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td class="bold left">2.3</td>
                        <td class="bold left">Nhân viên</td>
                        <td>người</td>
                        <td>125</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td></td>
                        <td class="left">Trong đó</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Nhân viên thư viện</td>
                        <td>người</td>
                        <td>126</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Nhân viên thiết bị, thí nghiệm</td>
                        <td>người</td>
                        <td>127</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Nhân viên y tế</td>
                        <td>người</td>
                        <td>128</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Nhân viên khác</td>
                        <td>người</td>
                        <td>129</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td class="bold left">2.4</td>
                        <td class="bold left">Giảng viên cơ hữu</td>
                        <td>người</td>
                        <td>130</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td></td>
                        <td class="left">Trong đó</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giáo sư</td>
                        <td>người</td>
                        <td>131</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Phó giáo sư</td>
                        <td>người</td>
                        <td>132</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td>2.4.1</td>
                        <td class="left">Chia theo trình độ đào tạo</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>


                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Đại học</td>
                        <td>người</td>
                        <td>133</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Thạc sĩ</td>
                        <td>người</td>
                        <td>134</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Tiến sĩ và TSKH</td>
                        <td>người</td>
                        <td>135</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Khác</td>
                        <td>người</td>
                        <td>136</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td>2.4.2</td>
                        <td class="left">Chia theo chức danh nghê nghiệp</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giảng viên cao cấp (hạng I)</td>
                        <td>người</td>
                        <td>137</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giảng viên chính (hạng II)</td>
                        <td>người</td>
                        <td>138</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giảng viên (hạng III)</td>
                        <td>người</td>
                        <td>139</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Trợ giảng</td>
                        <td>người</td>
                        <td>140</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td>2.4.3</td>
                        <td class="left">Chia theo độ tuổi</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">
                            < 30 tuổi</td> <td>người
                        </td>
                        <td>141</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 30 - 39 tuổi</td>
                        <td>người</td>
                        <td>142</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 40 - 49 tuổi</td>
                        <td>người</td>
                        <td>143</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 50 - 54 tuổi</td>
                        <td>người</td>
                        <td>144</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 55 - 59 tuổi</td>
                        <td>người</td>
                        <td>145</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left"> >= 60 tuổi</td>
                        <td>người</td>
                        <td>146</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td>2.4.4</td>
                        <td class="left"> Giảng viên nghỉ hưu trong năm</td>
                        <td>người</td>
                        <td>147</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td>2.4.4</td>
                        <td class="left"> Giảng viên tuyển mới trong năm</td>
                        <td>người</td>
                        <td>148</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>

                    {{-- Giảng viên thỉnh giảng --}}
                    <tr>
                        <td class="bold left">2.5</td>
                        <td class="bold left">Giảng viên thỉnh giảng</td>
                        <td>người</td>
                        <td>149</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td></td>
                        <td class="left">Trong đó</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giáo sư</td>
                        <td>người</td>
                        <td>150</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Phó giáo sư</td>
                        <td>người</td>
                        <td>151</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td>2.5.1</td>
                        <td class="left">Chia theo trình độ đào tạo</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Đại học</td>
                        <td>người</td>
                        <td>152</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Thạc sĩ</td>
                        <td>người</td>
                        <td>153</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Tiến sĩ và TSKH</td>
                        <td>người</td>
                        <td>154</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Khác</td>
                        <td>người</td>
                        <td>155</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td>2.5.2</td>
                        <td class="left">Chia theo chức danh nghê nghiệp</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giảng viên cao cấp (hạng I)</td>
                        <td>người</td>
                        <td>156</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giảng viên chính (hạng II)</td>
                        <td>người</td>
                        <td>157</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giảng viên (hạng III)</td>
                        <td>người</td>
                        <td>158</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Các chức danh nghề nghiệp khác</td>
                        <td>người</td>
                        <td>159</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td>2.5.3</td>
                        <td class="left">Chia theo độ tuổi</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">
                            < 30 tuổi</td> <td>người
                        </td>
                        <td>160</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 30 - 39 tuổi</td>
                        <td>người</td>
                        <td>161</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 40 - 49 tuổi</td>
                        <td>người</td>
                        <td>162</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 50 - 59 tuổi</td>
                        <td>người</td>
                        <td>163</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>

                    <tr>
                        <td></td>
                        <td class="left"> >= 60 tuổi</td>
                        <td>người</td>
                        <td>164</td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số">1
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc không xác định thời hạn">2</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng làm việc xác định thời hạn">3</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Hợp đồng lao động">4</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ">5</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số dân tộc thiểu số">6</div>
                        </td>
                        <td>
                            <div data-toggle="tooltip" title="Tổng số Nữ dân tộc thiểu số">7</div>
                        </td>

                    </tr>



                </tbody>

            </table>
        </div>
        <div class="panel-footer">

              </div>
</div>
<script type="text/JavaScript" src="{{asset('js/jquery.print.js')}}"></script>
<script>
    $(document).ready(function () {
        // $(".table-responsive").print();
        // $('[data-toggle="tooltip"]').tooltip({boundary: 'window'});

    });
</script>
@endsection
