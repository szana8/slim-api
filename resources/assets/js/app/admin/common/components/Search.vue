<template>
    <div class="row">
        <div class="container-fluid">
            <!-- Need to separate to own vue component-->
            <div class="col-md-4">
                <form class="form-horizontal" name="searchForm" id="searchFormId" method="GET">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" placeholder="Search" />
                    </div>
                </form>
            </div>
            <div class="cl-md-8 text-right">
                <a class="btn btn-default" href="#">Create</a>
            </div>
            <!-- End Search form -->
        </div>
    </div>
</template>

<script>

    export default {



    }

</script>