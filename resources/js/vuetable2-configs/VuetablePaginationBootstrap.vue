<template>
    <div class="dataTables_paginate paging_full_numbers">
        <ul class="pagination">
            <li :class="{'disabled': isOnFirstPage}" class="paginate_button page-item previous">
                <a @click.prevent="loadPage('prev')" class="page-link" href="">
                    <span><i class="la la-angle-double-left"></i></span>
                </a>
            </li>

            <template v-if="notEnoughPages">
                <li :class="{'active': isCurrentPage(n)}" class="paginate_button page-item" v-for="n in totalPage">
                    <a @click.prevent="loadPage(n)" class="page-link" v-html="n"></a>
                </li>
            </template>
            <template v-else>
                <li :class="{'active': isCurrentPage(windowStart+n-1)}" class="paginate_button page-item"
                    v-for="n in windowSize">
                    <a @click.prevent="loadPage(windowStart+n-1)" class="page-link" v-html="windowStart+n-1"></a>
                </li>
            </template>

            <li :class="{'disabled': isOnLastPage}" class="paginate_button page-item next">
                <a @click.prevent="loadPage('next')" class="page-link" href="">
                    <span><i class="la la-angle-double-right"></i></span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    import VuetablePaginationMixin from 'vuetable-2/src/components/VuetablePaginationMixin'

    export default {
        mixins: [VuetablePaginationMixin]
    }
</script>
<style scoped>
    .pagination > li{
        margin-right: 5px;
        padding:0;
        display: inline-block
    }
    .pagination > li > a, .pagination > li > span {
        border-radius: 50% !important;
        height: 2.5rem;
        min-width: 2.5rem;
        padding: 1rem;
        position: relative;
        display: flex;
        align-items: center;
        text-align: center;
        vertical-align: middle;
        font-size: 1rem;
        line-height: 1rem;
        border: none;
    }
    .pagination > li.next a, .pagination > li.previous a{
        padding: .65rem;
        color: #898b96;
        background: #ebe9f2;
    }

    .disabled .page-link {
        color: #898b96;
        background: #ebe9f2;
    }
</style>
