var DatatableRemoteAjaxDemo={init:function(){var t;t=$(".m_datatable").mDatatable({data:{type:"remote",source:{read:{url:"/api/incidents",method:"GET",map:function(t){var e=t;return void 0!==t.data&&(e=t.data.data),e}}},pageSize:10,serverPaging:!0,serverFiltering:!0,serverSorting:!0},layout:{scroll:!1,footer:!1},sortable:!0,pagination:!0,toolbar:{layout:["pagination","info"],placement:["bottom"],items:{pagination:{type:"default",pages:{desktop:{layout:"default",pagesNumber:6},tablet:{layout:"default",pagesNumber:3},mobile:{layout:"compact"}},navigation:{prev:!0,next:!0,first:!0,last:!0},pageSizeSelect:[10,20,30,50,100]},info:!0}},translate:{records:{processing:"Please wait...",noRecords:"No records found"},toolbar:{pagination:{items:{default:{first:"First",prev:"Previous",next:"Next",last:"Last",more:"More pages",input:"Page number",select:"Select page size"},info:"Displaying {{start}} - {{end}} of {{total}} records"}}}},search:{input:$("#generalSearch")},columns:[{field:"id",title:"#",sortable:!0,width:40,selector:!1,textAlign:"center"},{field:"reference",title:"Reference",sortable:!1,width:150,selector:!1,textAlign:"center"},{field:"name",title:"Name",filterable:!1,width:150},{field:"created",title:"Logged At",attr:{nowrap:"nowrap"},width:150,type:"date",format:"MM/DD/YYYY"},{field:"Status",title:"Status",template:function(t){var e=arrStatus;return'<span class="m-badge m-badge--'+e[t.status.id].class+' m-badge--wide">'+e[t.status.id].title+"</span>"}},{field:"category",title:"Category",template:function(t){var e=arrCategories;return'<span class="m-badge m-badge--'+e[t.category.id].class+' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-'+e[t.category.id].class+'">'+e[t.category.id].title+"</span>"}},{field:"location",title:"Location",template:"{{longitude}}, {{latitude}}"},{field:"suburb_id",title:"Suburb",width:100},{field:"Actions",width:110,title:"Actions",sortable:!1,overflow:"visible",template:function(t,e,a){return'\t\t\t\t\t\t<div class="dropdown '+(a.getPageSize()-e<=4?"dropup":"")+'">\t\t\t\t\t\t\t<a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">                                <i class="la la-ellipsis-h"></i>                            </a>\t\t\t\t\t\t  \t<div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\t\t\t\t\t\t  \t</div>\t\t\t\t\t\t</div>\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t'}}]}),$("#m_form_status").on("change",function(){t.search($(this).val(),"Status")}),$("#m_form_type").on("change",function(){t.search($(this).val(),"Type")}),$("#m_form_status, #m_form_type").selectpicker()}},arrCategories=[],LoadCategories={init:function(){$.ajax({url:"/api/system/categories",type:"GET",dataType:"json",complete:function(t){arrCategories=t.responseJSON.data,$("#loader").css("visibility","hidden")}})}},arrStatus=[],LoadStatuses={init:function(){$.ajax({url:"/api/system/statuses",type:"GET",dataType:"json",complete:function(t){arrStatus=t.responseJSON.data,$("#loader").css("visibility","hidden")}})}};jQuery(document).ready(function(){LoadCategories.init(),LoadStatuses.init(),DatatableRemoteAjaxDemo.init()});
