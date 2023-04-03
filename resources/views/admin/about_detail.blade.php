@include('admin.include.header')
<style type="text/css">
    .overview-wrap {
        color: #fff;
    }

    .table-data3 tbody tr td:last-child {
        text-align: left;
        padding-right: 50px;
    }
</style>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">



            <div class="row m-t-30">


                <div class="col-md-12">

                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table id="myTables" class="table table-borderless table-data3">
                            <tr>
                                <td style="width:200px"><label>Heading:</label></td>
                                <td>{{ $about->heading }}</td>
                            </tr>
                            <tr>
                                <td><label>Image:</label></td>
                                <td><img src="{{ url('public/upload/about_image/' . $about->image) }}" width="300px"
                                        height="300px"></td>
                            </tr>
                            <tr>
                                <td><label>Content:</label></td>
                                <td><?= $about->content ?></td>
                            </tr>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
            <script type="text/javascript">
                function delete_ins(th) {

                    var id = $(th).data('id');



                    var token = "<?php echo csrf_token(); ?>";

                    if (confirm('Are you sure?')) {

                        $.ajax({

                            type: 'POST',

                            url: '{{ url('admin/delete_course') }}',

                            data: {
                                id: id,
                                _token: token
                            },

                            success: function(data) {

                                location.reload();

                            }

                        })

                    }

                }
            </script>
            @include('admin.include.footer')
