@extends('employee.master')
@section('title','Chi tiết bằng cấp')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li class=""><a href="{{route('employee.faculty.index')}}">Quản lý khoa</a></li>
                <li class=""><a href="{{route('admin.pi.detail',$pi->id)}}">Thông tin cá nhân - {{App\PI::find($pi->id)->employee_code}}</a></li>
                
                <li >Danh sách bằng cấp</li>
            </ol>
        </div>
    </div>
@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
    <div class="cm-flex">
        <div class="nav-tabs-container  table-responsive">
            <ul class="nav nav-tabs">
                <li class="{{url()->current() == route('employee.faculty.detail',$pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.detail',$pi->id) }}">Thông tin cá nhân</a></li>
                <li class="{{url()->current() == route('employee.faculty.workload',$pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.workload',$pi->id)}}">khối lượng giảng dạy</a></li>
                <li class="{{url()->current() == route('employee.faculty.srworkload.index',$pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.srworkload.index',$pi->id)}}">khối lượng NCKH</a></li>
                <li class="{{url()->current() == route('employee.faculty.sb',$pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.sb',$pi->id) }}">lý lịch khoa học</a></li>
            </ul>
        </div>
    </div>
</nav>
@endsection
@section('content')
  @if(session()->has('message'))
      <div class="alert alert-success mt-10">
          {{ session()->get('message') }}
      </div>
  @endif
  <div style="padding-top:71px">
        <div class="panel panel-default">
                <div class="panel-heading">Danh sách bằng cấp<br>
                    {{-- <a href="{{route('employee.faculty.degree.list')}}">
                        <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
                    </a> --}}
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" action="{{ route('employee.faculty.degree.list',$pi->id) }}" method="get" style="margin-bottom:0">
                        <thead>
                            <tr>
                                <th>Loại</th>
                                <th>Chuyên ngành</th>
                                <th>Ngày cấp </th>
                                <th>Nơi cấp</th>
                                <th>Nước cấp</th>
                                <th>Loại bằng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @if($degrees->count() >0)
                         @foreach($degrees as $degree)
                                <tr>
                                <td class="">{{$degree->degree->name}}</td>
                                <td class="">{{$degree->specialized}}</td>
                                <td class="">{{date('d-m-Y', strtotime($degree->date_of_issue))}}</td>
                                <td class="">{{$degree->place_of_issue}}</td>
                                <td class="">{{$degree->nation_of_issue_id}}</td>
                                <td class="">{{$degree->degree_type}}</td>

                                <td></td>

                                </tr>

                                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="degree-delete-modal">

                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xoá bằng cấp này ?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" id="btn-pd-yes">Có</button>
                                                <button type="button" class="btn btn-default" id="btn-pd-no">Không</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endcan --}}
                        @endforeach
                      @else
                        <tr>
                          <td colspan="7" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
                        </tr>
                      @endif
                        </tbody>
                    </table>
                </div>

</div>

@endsection
