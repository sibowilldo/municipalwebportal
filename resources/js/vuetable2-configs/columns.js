export default{
   columns:  [
       {
           name: '__sequence',
           title: '#',
           titleClass: 'center aligned',
           dataClass: 'right aligned'
       },
       {
           name: "reference",
           title: "Reference"
       },
       {
           name: "name",
           title: "Summary",
           sortField: "name"
       },
       {
           name: "coordinates",
           title: "Location",
           callback: 'formatCoordinates',
           width: "250px"
       },
       {
           name: "created",
           title: "Reported On",
           sortField: "created_at",
           titleClass: "text-center",
           dataClass: "text-center",
           callback: 'formatDate|YYYY-MM-DD H:mm:ss'
       },
       {
           name: "status",
           title: "Status",
           callback: "statusColumnFn"
       },
       {
           name: "category",
           title: "Category",
           callback: 'categoryColumnFn'
       },
       {
           name: '__slot:actions',
           title: '',
           titleClass: 'text-center',
           dataClass: 'text-center',
       }
   ]
}
