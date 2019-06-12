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
            
            <a href="{{route('admin.statistic.download')}}">
                <button type="button" name="button" class="btn btn-xs btn-success">Xuất Excel</button>
            </a>
            
        </div>
    </div>
    <div class="panel-body">

        <div class="form-group col-sm-12 mt-25 mb-5">
            <h2 class="text-center">Số Cán bộ, Giảng viên, Nhân viên</h2>
        <span class="help-text text-center">Năm : {{Carbon\Carbon::now()->format('Y')}}</span>
        </div>

    </div>
    <div class="table-responsive">
            <table class="table table-hover table-bordered statistic-table">
                <thead>
                    <tr>
                        <th rowspan="4">#</th>
                        <th class="col-sm-3" rowspan="4">Cán bộ quản lý, Giảng viên, Nhân viên</th>
                        <th rowspan="4">Đơn vị tính</th>
                        <th rowspan="4">Mã số</th>
                        <th rowspan="4">Tổng số</th>
                        <th colspan="6"><span>Trong đó</span></th>
                    </tr>
                    <tr>
                        <th colspan="3">Phân loại</th>
                        <th class="col-sm-1" rowspan="3">Nữ</th>
                        <th class="col-sm-2" colspan="2">Dân tộc thiểu số</th>
                    </tr>
                    <tr>
                        <th class="col-sm-3" colspan="2">Viên chức</th>
                        <th rowspan="2">Hợp đồng lao động</th>
                        <th rowspan="2">Tổng số</th>
                        <th rowspan="2">Nữ</th>
                    </tr>
                    <tr>
                        <th>Hợp đồng làm việc không xác định thời hạn</th>
                        <th>Hợp đồng làm việc xác định thời hạn</th>
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

                    </tr>
                    <tr>
                        <td></td>
                        <td class="bold">Tổng số</td>
                        <td>người</td>
                        <td>105</td>
                        <td  title="Tổng số">
                            {{$pis->first()->getPI()->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$pis->first()->getPI(1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$pis->first()->getPI(2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$pis->first()->getPI(3)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                                {{$pis->first()->getPI(999,1)->count()}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$pis->first()->getPI(999,999,1)->count()}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$pis->first()->getPI(999,1,1)->count()}}
                        </td>

                    </tr>
                    <tr>
                        <td class="left bold">2.1</td>
                        <td class="left bold">Cán bộ quản lý</td>
                        <td>người</td>
                        <td>106</td>
                        <td  title="Tổng số">
                                {{$officers->first()->getOfficerByAcademicRankType(1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(1,999,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$officers->first()->getOfficerByAcademicRankType(1,999,2)->count()}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$officers->first()->getOfficerByAcademicRankType(1,999,3)->count()}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{($officers->first()->getOfficerByAcademicRankType(1,999,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{($officers->first()->getOfficerByAcademicRankType(1,999,999,999,1)->count())}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{($officers->first()->getOfficerByAcademicRankType(1,999,999,1,1)->count())}}
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

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Hiệu trưởng</td>
                        <td>người</td>
                        <td>107</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByPosition(1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$officers->first()->getOfficerByPosition(1,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$officers->first()->getOfficerByPosition(1,2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$officers->first()->getOfficerByPosition(1,3)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{{($officers->first()->getOfficerByPosition(1,999,1)->count())}}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{{($officers->first()->getOfficerByPosition(1,999,999,1)->count())}}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{{($officers->first()->getOfficerByPosition(1,999,1,1)->count())}}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Phó hiệu trưởng</td>
                        <td>người</td>
                        <td>108</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByPosition(2)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$officers->first()->getOfficerByPosition(2,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$officers->first()->getOfficerByPosition(2,2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$officers->first()->getOfficerByPosition(2,3)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                                {{{($officers->first()->getOfficerByPosition(2,999,1)->count())}}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{{($officers->first()->getOfficerByPosition(2,999,999,1)->count())}}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{{($officers->first()->getOfficerByPosition(2,999,1,1)->count())}}}
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
                        <td>109</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByAcademicRankType(1,2)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(1,2,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(1,2,2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByAcademicRankType(1,2,3)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{($officers->first()->getOfficerByAcademicRankType(1,2,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{($officers->first()->getOfficerByAcademicRankType(1,2,999,999,1)->count())}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{($officers->first()->getOfficerByAcademicRankType(1,2,999,1,999)->count())}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Phó giáo sư</td>
                        <td>người</td>
                        <td>110</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByAcademicRankType(1,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(1,1,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(1,1,2)->count()}}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByAcademicRankType(1,1,3)->count()}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{($officers->first()->getOfficerByAcademicRankType(1,1,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{($officers->first()->getOfficerByAcademicRankType(1,1,999,999,1)->count())}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{($officers->first()->getOfficerByAcademicRankType(1,1,999,1,1)->count())}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Kiêm nhiệm giảng dạy</td>
                        <td>người</td>
                        <td>111</td>
                        <td  title="Tổng số">
                                {{$officers->first()->getOfficerByAcademicRankType(1)->where('is_concurrently',1)->count()}}

                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(1,999,1)->where('is_concurrently',1)->count()}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(1,999,2)->where('is_concurrently',1)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByAcademicRankType(1,999,3)->where('is_concurrently',1)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                                {{$officers->first()->getOfficerByAcademicRankType(1,999,999,1)->where('is_concurrently',1)->count()}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$officers->first()->getOfficerByAcademicRankType(1,999,999,999,1)->where('is_concurrently',1)->count()}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$officers->first()->getOfficerByAcademicRankType(1,999,999,1,1)->where('is_concurrently',1)->count()}}

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
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByDegreeType(1,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByDegreeType(1,1,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$officers->first()->getOfficerByDegreeType(1,1,2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$officers->first()->getOfficerByDegreeType(1,1,3)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                                {{($officers->first()->getOfficerByDegreeType(1,1,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{($officers->first()->getOfficerByDegreeType(1,1,999,999,1)->count())}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{($officers->first()->getOfficerByDegreeType(1,1,999,1,1)->count())}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Thạc sĩ</td>
                        <td>người</td>
                        <td>113</td>
                        <td  title="Tổng số">
                            {{($officers->first()->getOfficerByDegreeType(1,2)->count())+($officers->first()->getOfficerByDegreeType(1,4)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{($officers->first()->getOfficerByDegreeType(1,2,1)->count())+($officers->first()->getOfficerByDegreeType(1,4,1)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{($officers->first()->getOfficerByDegreeType(1,2,2)->count())+($officers->first()->getOfficerByDegreeType(1,4,2)->count())}}
                        </td>
                        <td  title="Hợp đồng lao động">
                                {{($officers->first()->getOfficerByDegreeType(1,2,3)->count())+($officers->first()->getOfficerByDegreeType(1,4,3)->count())}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{($officers->first()->getOfficerByDegreeType(1,2,999,1)->count())+($officers->first()->getOfficerByDegreeType(1,4,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{($officers->first()->getOfficerByDegreeType(1,2,999,999,1)->count())+($officers->first()->getOfficerByDegreeType(1,4,999,999,1)->count())}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{($officers->first()->getOfficerByDegreeType(1,2,999,1,1)->count())+($officers->first()->getOfficerByDegreeType(1,4,999,1,1)->count())}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Tiến sĩ và TSKH</td>
                        <td>người</td>
                        <td>114</td>
                        <td  title="Tổng số">
                            {{($officers->first()->getOfficerByDegreeType(1,3)->count())+($officers->first()->getOfficerByDegreeType(1,5)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{($officers->first()->getOfficerByDegreeType(1,3,1)->count())+($officers->first()->getOfficerByDegreeType(1,5,1)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{($officers->first()->getOfficerByDegreeType(1,3,2)->count())+($officers->first()->getOfficerByDegreeType(1,5,2)->count())}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{($officers->first()->getOfficerByDegreeType(1,3,3)->count())+($officers->first()->getOfficerByDegreeType(1,5,3)->count())}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{($officers->first()->getOfficerByDegreeType(1,3,999,1)->count())+($officers->first()->getOfficerByDegreeType(1,5,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{($officers->first()->getOfficerByDegreeType(1,3,999,999,1)->count())+($officers->first()->getOfficerByDegreeType(1,5,999,999,1)->count())}}


                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{($officers->first()->getOfficerByDegreeType(1,3,999,1,1)->count())+($officers->first()->getOfficerByDegreeType(1,5,999,1,1)->count())}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Khác</td>
                        <td>người</td>
                        <td>115</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByDegreeType(1,9)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$officers->first()->getOfficerByDegreeType(1,9,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$officers->first()->getOfficerByDegreeType(1,9,2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$officers->first()->getOfficerByDegreeType(1,9,3)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                                {{($officers->first()->getOfficerByDegreeType(1,9,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{($officers->first()->getOfficerByDegreeType(1,9,999,999,1)->count())}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{($officers->first()->getOfficerByDegreeType(1,9,999,1,1)->count())}}

                        </td>

                    </tr>
                    <tr>
                        <td class="bold left">2.2</td>
                        <td class="bold left">Cán bộ hành chính, nghiệp vụ</td>
                        <td>người</td>
                        <td>116</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByAcademicRankType(2)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,3)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,999,1)->count()}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,999,999,1)->count()}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,999,1,1)->count()}}
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
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByAcademicRankType(2,2)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(2,2,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(2,2,2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByAcademicRankType(2,2,3)->count()}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByAcademicRankType(2,2,999,1)->count()}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByAcademicRankType(2,2,999,999,1)->count()}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByAcademicRankType(2,2,999,1,1)->count()}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Phó giáo sư</td>
                        <td>người</td>
                        <td>118</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByAcademicRankType(2,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(2,1,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(2,1,2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByAcademicRankType(2,1,3)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByAcademicRankType(2,1,999,1)->count()}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByAcademicRankType(2,1,999,999,1)->count()}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByAcademicRankType(2,1,999,1,1)->count()}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Kiêm nhiệm giảng dạy</td>
                        <td>người</td>
                        <td>119</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByAcademicRankType(2)->where('is_concurrently',1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,1)->where('is_concurrently',1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,2)->where('is_concurrently',1)->count()}}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,3)->where('is_concurrently',1)->count()}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,999,1)->where('is_concurrently',1)->count()}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,999,999,1)->where('is_concurrently',1)->count()}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByAcademicRankType(2,999,999,1,1)->where('is_concurrently',1)->count()}}
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
                        <td  title="Tổng số">
                            0
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            0
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            0
                        </td>
                        <td  title="Hợp đồng lao động">
                            0
                        </td>
                        <td   title="Tổng số Nữ">
                            0
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            0
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            0
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Đại học</td>
                        <td>người</td>
                        <td>121</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByDegreeType(2,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByDegreeType(2,1,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByDegreeType(2,1,2)->count()}}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByDegreeType(2,1,3)->count()}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByDegreeType(2,1,999,1)->count()}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByDegreeType(2,1,999,999,1)->count()}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByDegreeType(2,1,999,1,1)->count()}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Thạc sĩ</td>
                        <td>người</td>
                        <td>122</td>
                        <td  title="Tổng số">
                            {{($officers->first()->getOfficerByDegreeType(2,2)->count())+($officers->first()->getOfficerByDegreeType(2,4)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{($officers->first()->getOfficerByDegreeType(2,2,1)->count())+($officers->first()->getOfficerByDegreeType(2,4,1)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{($officers->first()->getOfficerByDegreeType(2,2,2)->count())+($officers->first()->getOfficerByDegreeType(2,4,2)->count())}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{($officers->first()->getOfficerByDegreeType(2,2,3)->count())+($officers->first()->getOfficerByDegreeType(2,4,3)->count())}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{($officers->first()->getOfficerByDegreeType(2,2,999,1)->count())+($officers->first()->getOfficerByDegreeType(2,4,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{($officers->first()->getOfficerByDegreeType(2,2,999,999,1)->count())+($officers->first()->getOfficerByDegreeType(2,4,999,999,1)->count())}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{($officers->first()->getOfficerByDegreeType(2,2,999,1,1)->count())+($officers->first()->getOfficerByDegreeType(2,4,999,1,1)->count())}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Tiến sĩ và TSKH</td>
                        <td>người</td>
                        <td>123</td>
                        <td  title="Tổng số">
                            {{($officers->first()->getOfficerByDegreeType(2,3)->count())+($officers->first()->getOfficerByDegreeType(2,5)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{($officers->first()->getOfficerByDegreeType(2,3,1)->count())+($officers->first()->getOfficerByDegreeType(2,5,1)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{($officers->first()->getOfficerByDegreeType(2,3,2)->count())+($officers->first()->getOfficerByDegreeType(2,5,2)->count())}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{($officers->first()->getOfficerByDegreeType(2,3,3)->count())+($officers->first()->getOfficerByDegreeType(2,5,3)->count())}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{($officers->first()->getOfficerByDegreeType(2,3,999,1)->count())+($officers->first()->getOfficerByDegreeType(2,5,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{($officers->first()->getOfficerByDegreeType(2,3,999,999,1)->count())+($officers->first()->getOfficerByDegreeType(2,5,999,999,1)->count())}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{($officers->first()->getOfficerByDegreeType(2,3,999,1,1)->count())+($officers->first()->getOfficerByDegreeType(2,5,999,1,1)->count())}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Khác</td>
                        <td>người</td>
                        <td>124</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByDegreeType(2,9)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByDegreeType(2,9,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByDegreeType(2,9,2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByDegreeType(2,9,3)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByDegreeType(2,9,999,1)->count()}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByDegreeType(2,9,999,999,1)->count()}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByDegreeType(2,9,999,1,1)->count()}}
                        </td>

                    </tr>
                    <tr>
                        <td class="bold left">2.3</td>
                        <td class="bold left">Nhân viên</td>
                        <td>người</td>
                        <td>125</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByDegreeType(3)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByDegreeType(3,999,1)->count()}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByDegreeType(3,999,2)->count()}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByDegreeType(3,999,3)->count()}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByDegreeType(3,999,999,1)->count()}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByDegreeType(3,999,999,999,1)->count()}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByDegreeType(3,999,999,1,1)->count()}}

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
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByPosition(3)->count() }}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByPosition(3,1)->count() }}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByPosition(3,2)->count() }}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByPosition(3,3)->count() }}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByPosition(3,999,1)->count() }}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByPosition(3,999,999,1)->count() }}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByPosition(3,999,1,1)->count() }}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Nhân viên thiết bị, thí nghiệm</td>
                        <td>người</td>
                        <td>127</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByPosition(4)->count() }}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByPosition(4,1)->count() }}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByPosition(4,2)->count() }}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByPosition(4,3)->count() }}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByPosition(4,999,1)->count() }}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByPosition(4,999,999,1)->count() }}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByPosition(4,999,1,1)->count() }}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Nhân viên y tế</td>
                        <td>người</td>
                        <td>128</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByPosition(5)->count() }}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByPosition(5,1)->count() }}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByPosition(5,2)->count() }}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByPosition(5,3)->count() }}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByPosition(5,999,1)->count() }}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByPosition(5,999,999,1)->count() }}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByPosition(5,999,1,1)->count() }}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Nhân viên khác</td>
                        <td>người</td>
                        <td>129</td>
                        <td  title="Tổng số">
                            {{$officers->first()->getOfficerByPosition(6)->count() }}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$officers->first()->getOfficerByPosition(6,1)->count() }}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$officers->first()->getOfficerByPosition(6,2)->count() }}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$officers->first()->getOfficerByPosition(6,3)->count() }}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$officers->first()->getOfficerByPosition(6,999,1)->count() }}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$officers->first()->getOfficerByPosition(6,999,999,1)->count() }}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$officers->first()->getOfficerByPosition(6,999,1,1)->count() }}

                        </td>

                    </tr>
                    <tr>
                        <td class="bold left">2.4</td>
                        <td class="bold left">Giảng viên cơ hữu</td>
                        <td>người</td>
                        <td>130</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1)->count() : 0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ?$teachers->first()->getTeacherByAcademicRankType(1,999,1)->count() : 0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ?$teachers->first()->getTeacherByAcademicRankType(1,999,2)->count() : 0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ?$teachers->first()->getTeacherByAcademicRankType(1,999,3)->count() : 0}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ?$teachers->first()->getTeacherByAcademicRankType(1,999,999,1)->count() : 0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ?$teachers->first()->getTeacherByAcademicRankType(1,999,999,999,1)->count() : 0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ?$teachers->first()->getTeacherByAcademicRankType(1,999,999,1,1)->count() : 0}}

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
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,2,1)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,2,2)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,2,3)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,2,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,2,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,2,999,1,1)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Phó giáo sư</td>
                        <td>người</td>
                        <td>132</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,1)->count() : 0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,1,1)->count() : 0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,1,2)->count() : 0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,1,3)->count() : 0}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,1,999,1)->count() : 0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,1,999,999,1)->count() : 0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(1,1,999,1,1)->count() : 0}}

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
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,1,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,1,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,1,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,1,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,1,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,1,999,1,1)->count():0}}
                        </td>

                    </tr>
                    @if($teachers->first() != null)
                    <tr>
                        <td></td>
                        <td class="left">Thạc sĩ</td>
                        <td>người</td>
                        <td>134</td>
                        <td  title="Tổng số">
                            {{($teachers->first()->getTeacherByDegreeType(1,2)->count())+($teachers->first()->getTeacherByDegreeType(1,4)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{($teachers->first()->getTeacherByDegreeType(1,2,1)->count())+($teachers->first()->getTeacherByDegreeType(1,4,1)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{($teachers->first()->getTeacherByDegreeType(1,2,2)->count())+($teachers->first()->getTeacherByDegreeType(1,4,2)->count())}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{($teachers->first()->getTeacherByDegreeType(1,2,3)->count())+($teachers->first()->getTeacherByDegreeType(1,4,3)->count())}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{($teachers->first()->getTeacherByDegreeType(1,2,999,1)->count())+($teachers->first()->getTeacherByDegreeType(1,4,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{($teachers->first()->getTeacherByDegreeType(1,2,999,999,1)->count())+($teachers->first()->getTeacherByDegreeType(1,4,999,999,1)->count())}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{($teachers->first()->getTeacherByDegreeType(1,2,999,1,1)->count())+($teachers->first()->getTeacherByDegreeType(1,4,999,1,1)->count())}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Tiến sĩ và TSKH</td>
                        <td>người</td>
                        <td>135</td>
                        <td  title="Tổng số">
                            {{($teachers->first()->getTeacherByDegreeType(1,3)->count())+($teachers->first()->getTeacherByDegreeType(1,5)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{($teachers->first()->getTeacherByDegreeType(1,3,1)->count())+($teachers->first()->getTeacherByDegreeType(1,5,1)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{($teachers->first()->getTeacherByDegreeType(1,3,2)->count())+($teachers->first()->getTeacherByDegreeType(1,5,2)->count())}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{($teachers->first()->getTeacherByDegreeType(1,3,3)->count())+($teachers->first()->getTeacherByDegreeType(1,5,3)->count())}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{($teachers->first()->getTeacherByDegreeType(1,3,999,1)->count())+($teachers->first()->getTeacherByDegreeType(1,5,999,1)->count())}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{($teachers->first()->getTeacherByDegreeType(1,3,999,999,1)->count())+($teachers->first()->getTeacherByDegreeType(1,5,999,999,1)->count())}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{($teachers->first()->getTeacherByDegreeType(1,3,999,1,1)->count())+($teachers->first()->getTeacherByDegreeType(1,5,999,1,1)->count())}}

                        </td>

                    </tr>
                    @else
                    <tr>
                        <td></td>
                        <td class="left">Thạc sĩ</td>
                        <td>người</td>
                        <td>134</td>
                        <td  title="Tổng số">
                            0
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            0
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            0
                        </td>
                        <td  title="Hợp đồng lao động">
                            0
                        </td>
                        <td   title="Tổng số Nữ">
                            0
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            0
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            0
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Tiến sĩ và TSKH</td>
                        <td>người</td>
                        <td>135</td>
                        <td  title="Tổng số">
                            0
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            0
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            0
                        </td>
                        <td  title="Hợp đồng lao động">
                            0
                        </td>
                        <td   title="Tổng số Nữ">
                            0
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            0

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            0

                        </td>

                    </tr>
                    @endif
                    
                    <tr>
                        <td></td>
                        <td class="left">Khác</td>
                        <td>người</td>
                        <td>136</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,9)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,9,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,9,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,9,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,9,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,9,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,9,999,1,1)->count():0}}
                        </td>

                    </tr>
                    <tr class="disabled">
                        <td>2.4.2</td>
                        <td class="left">Chia theo chức danh nghề nghiệp</td>
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
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1)->where('title_id',1)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,1)->where('title_id',1)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,2)->where('title_id',1)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,3)->where('title_id',1)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,1)->where('title_id',1)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,999,1)->where('title_id',1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,1,1)->where('title_id',1)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giảng viên chính (hạng II)</td>
                        <td>người</td>
                        <td>138</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1)->where('title_id',2)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,1)->where('title_id',2)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,2)->where('title_id',2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,3)->where('title_id',2)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,1)->where('title_id',2)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,999,1)->where('title_id',2)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,1,1)->where('title_id',2)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giảng viên (hạng III)</td>
                        <td>người</td>
                        <td>139</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1)->where('title_id',3)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,1)->where('title_id',3)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,2)->where('title_id',3)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,3)->where('title_id',3)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,1)->where('title_id',3)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,999,1)->where('title_id',3)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,1,1)->where('title_id',3)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Trợ giảng</td>
                        <td>người</td>
                        <td>140</td>
                        <td  title="Tổng số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1)->where('title_id',4)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,1)->where('title_id',4)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,2)->where('title_id',4)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,3)->where('title_id',4)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,1)->where('title_id',4)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,999,1)->where('title_id',4)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(1,999,999,1,1)->where('title_id',4)->count():0}}
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
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,0,30)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,0,30,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,0,30,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,0,30,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,0,30,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,0,30,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,0,30,999,1,1)->count():0}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 30 - 39 tuổi</td>
                        <td>người</td>
                        <td>142</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,30,40)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,30,40,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,30,40,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,30,40,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,30,40,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,30,40,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,30,40,999,1,1)->count():0}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 40 - 49 tuổi</td>
                        <td>người</td>
                        <td>143</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,40,50)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,40,50,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,40,50,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,40,50,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,40,50,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,40,50,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,40,50,999,1,1)->count():0}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 50 - 54 tuổi</td>
                        <td>người</td>
                        <td>144</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,50,55)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,50,55,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,50,55,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,50,55,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,50,55,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,50,55,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,50,55,999,1,1)->count():0}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 55 - 59 tuổi</td>
                        <td>người</td>
                        <td>145</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,55,60)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,55,60,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,55,60,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,55,60,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,55,60,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,55,60,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,55,60,999,1,1)->count():0}}
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left"> >= 60 tuổi</td>
                        <td>người</td>
                        <td>146</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,60,150)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,60,150,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,60,150,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,60,150,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,60,150,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,60,150,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(1,60,150,999,1,1)->count():0}}
                        </td>

                    </tr>
                    <tr>
                        <td>2.4.4</td>
                        <td class="left"> Giảng viên nghỉ hưu trong năm</td>
                        <td>người</td>
                        <td>147</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRetirementInYear(1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRetirementInYear(1,1)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRetirementInYear(1,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRetirementInYear(1,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRetirementInYear(1,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRetirementInYear(1,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRetirementInYear(1,999,1,1)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td>2.4.5</td>
                        <td class="left"> Giảng viên tuyển mới trong năm</td>
                        <td>người</td>
                        <td>148</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRecruimentInYear(1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByRecruimentInYear(1,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRecruimentInYear(1,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRecruimentInYear(1,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByRecruimentInYear(1,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByRecruimentInYear(1,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByRecruimentInYear(1,999,1,1)->count():0}}
                        </td>

                    </tr>

                    {{-- Giảng viên thỉnh giảng --}}
                    <tr>
                        <td class="bold left">2.5</td>
                        <td class="bold left">Giảng viên thỉnh giảng</td>
                        <td>người</td>
                        <td>149</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,999,1)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,999,2)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,999,3)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,999,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,999,999,1,1)->count():0}}

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
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,2,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,2,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,2,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,2,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,2,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,2,999,1,1)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Phó giáo sư</td>
                        <td>người</td>
                        <td>151</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,1,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,1,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,1,3)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,1,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,1,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAcademicRankType(2,1,999,1,1)->count():0}}
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
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,1,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,1,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,1,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,1,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,1,999,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,1,999,1,1)->count():0}}
                        </td>

                    </tr>
                    @if($teachers->first() != null)
                    <tr>
                        <td></td>
                        <td class="left">Thạc sĩ</td>
                        <td>người</td>
                        <td>153</td>
                        <td  title="Tổng số">
                            {{($teachers->first()->getTeacherByDegreeType(2,2)->count())+($teachers->first()->getTeacherByDegreeType(2,4)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{($teachers->first()->getTeacherByDegreeType(2,2,1)->count())+($teachers->first()->getTeacherByDegreeType(2,4,1)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{($teachers->first()->getTeacherByDegreeType(2,2,2)->count())+($teachers->first()->getTeacherByDegreeType(2,4,2)->count())}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{($teachers->first()->getTeacherByDegreeType(2,2,3)->count())+($teachers->first()->getTeacherByDegreeType(2,4,3)->count())}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{($teachers->first()->getTeacherByDegreeType(2,2,999,1)->count())+($teachers->first()->getTeacherByDegreeType(2,4,999,1)->count())}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{($teachers->first()->getTeacherByDegreeType(2,2,999,999,1)->count())+($teachers->first()->getTeacherByDegreeType(2,4,999,999,1)->count())}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{($teachers->first()->getTeacherByDegreeType(2,2,999,1,1)->count())+($teachers->first()->getTeacherByDegreeType(2,4,999,1,1)->count())}}

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Tiến sĩ và TSKH</td>
                        <td>người</td>
                        <td>154</td>
                        <td  title="Tổng số">
                            {{($teachers->first()->getTeacherByDegreeType(2,3)->count())+($teachers->first()->getTeacherByDegreeType(2,5)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{($teachers->first()->getTeacherByDegreeType(2,3,1)->count())+($teachers->first()->getTeacherByDegreeType(2,5,1)->count())}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{($teachers->first()->getTeacherByDegreeType(2,3,2)->count())+($teachers->first()->getTeacherByDegreeType(2,5,2)->count())}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{($teachers->first()->getTeacherByDegreeType(2,3,3)->count())+($teachers->first()->getTeacherByDegreeType(2,5,3)->count())}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{($teachers->first()->getTeacherByDegreeType(2,3,999,1)->count())+($teachers->first()->getTeacherByDegreeType(2,5,999,1)->count())}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{($teachers->first()->getTeacherByDegreeType(2,3,999,999,1)->count())+($teachers->first()->getTeacherByDegreeType(2,5,999,999,1)->count())}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{($teachers->first()->getTeacherByDegreeType(2,3,999,1,1)->count())+($teachers->first()->getTeacherByDegreeType(2,5,999,1,1)->count())}}

                        </td>

                    </tr>
                    @else
                    <tr>
                        <td></td>
                        <td class="left">Thạc sĩ</td>
                        <td>người</td>
                        <td>153</td>
                        <td  title="Tổng số">
                            0
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                0
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                0

                        </td>
                        <td  title="Hợp đồng lao động">
                                0

                        </td>
                        <td   title="Tổng số Nữ">
                                0

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                0

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                0

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Tiến sĩ và TSKH</td>
                        <td>người</td>
                        <td>154</td>
                        <td  title="Tổng số">
                            0
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                0
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                0

                        </td>
                        <td  title="Hợp đồng lao động">
                                0

                        </td>
                        <td   title="Tổng số Nữ">
                                0

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                0

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                0

                        </td>

                    </tr>
                    @endif
                    
                   
                    <tr>
                        <td></td>
                        <td class="left">Khác</td>
                        <td>người</td>
                        <td>155</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,9)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,9,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,9,2)->count():0}}
                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,9,3)->count():0}}
                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,9,999,1)->count():0}}
                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,9,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,9,999,1,1)->count():0}}

                        </td>

                    </tr>
                    <tr class="disabled">
                        <td>2.5.2</td>
                        <td class="left">Chia theo chức danh nghề nghiệp</td>
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
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2)->where('title_id',1)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,1)->where('title_id',1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,2)->where('title_id',1)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,3)->where('title_id',1)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,1)->where('title_id',1)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,999,1)->where('title_id',1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,1,1)->where('title_id',1)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giảng viên chính (hạng II)</td>
                        <td>người</td>
                        <td>157</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2)->where('title_id',2)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,1)->where('title_id',2)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,2)->where('title_id',2)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,3)->where('title_id',2)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,1)->where('title_id',2)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,999,1)->where('title_id',2)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,1,1)->where('title_id',2)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Giảng viên (hạng III)</td>
                        <td>người</td>
                        <td>158</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2)->where('title_id',3)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,1)->where('title_id',3)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,2)->where('title_id',3)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,3)->where('title_id',3)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,1)->where('title_id',3)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,999,1)->where('title_id',3)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,1,1)->where('title_id',3)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Các chức danh nghề nghiệp khác</td>
                        <td>người</td>
                        <td>159</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2)->where('title_id',5)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,1)->where('title_id',5)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,2)->where('title_id',5)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,3)->where('title_id',5)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,1)->where('title_id',5)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,999,1)->where('title_id',5)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByDegreeType(2,999,999,1,1)->where('title_id',5)->count():0}}

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
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,0,30)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,0,30,1)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,0,30,2)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,0,30,3)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,0,30,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,0,30,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,0,30,999,1,1)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 30 - 39 tuổi</td>
                        <td>người</td>
                        <td>161</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,30,40)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,30,40,1)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,30,40,2)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,30,40,3)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,30,40,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,30,40,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,30,40,999,1,1)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 40 - 49 tuổi</td>
                        <td>người</td>
                        <td>162</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,40,50)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,40,50,1)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,40,50,2)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,40,50,3)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,40,50,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,40,50,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,40,50,999,1,1)->count():0}}

                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td class="left">Từ 50 - 59 tuổi</td>
                        <td>người</td>
                        <td>163</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,50,60)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,50,60,1)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,50,60,2)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,50,60,3)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,50,60,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,50,60,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,50,60,999,1,1)->count():0}}

                        </td>

                    </tr>

                    <tr>
                        <td></td>
                        <td class="left"> >= 60 tuổi</td>
                        <td>người</td>
                        <td>164</td>
                        <td  title="Tổng số">
                            {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,60,150)->count():0}}
                        </td>
                        <td  title="Hợp đồng làm việc không xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,60,150,1)->count():0}}

                        </td>
                        <td  title="Hợp đồng làm việc xác định thời hạn">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,60,150,2)->count():0}}

                        </td>
                        <td  title="Hợp đồng lao động">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,60,150,3)->count():0}}

                        </td>
                        <td   title="Tổng số Nữ">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,60,150,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,60,150,999,999,1)->count():0}}

                        </td>
                        <td  title="Tổng số Nữ dân tộc thiểu số">
                                {{$teachers->first() != null ? $teachers->first()->getTeacherByAge(2,60,150,999,1,1)->count():0}}

                        </td>

                    </tr>



                </tbody>

            </table>
        </div>
        <div class="panel-footer">

              </div>
</div>

@endsection
