require('./bootstrap');

window.Vue = require('vue');
Vue.component('select-component',{

})
const app = new Vue({
    el: '#test',
    data:{
        tournaments:[],
        teams: [],
        groups:[],
        outcomes:[],
        gmap: null,
        markers: [],
        team:[],
        team_from_group:[],
        searchs:[],
        search_teams:[],
        search_ene:[],
        latitudes:[],
        longitudes:[],
        latitudes_ene:[],
        longitudes_ene:[],
        latitudes_blue:[],
        longitudes_blue:[],
        team_blue:[],
        latitudes_blue_ene:[],
        longitudes_blue_ene:[],
        team_blue_ene:[],
        gmap_team:[],
        select_tournament_name:[],
        selsct_team:[],
        select_outcome:[],
        isDisplayGroup: "none",
        isDisplayOutcome: "none"
    },

    mounted: async function () {
        await this.sleep(1000);   // wait until loading google map javascript
        this.map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 0, lng: 0 },
            zoom: 1
        });
    },
    methods:{
        sleep: function (msec) {
            return new Promise((resolve) => {
                setTimeout(() => { resolve() }, msec);
            })
        },
        select_team:function(team_name){
            this.select_team = team_name;
            this.isDisplayOutcome = "block";
        },
        select_out:function(outcome_name){
            this.select_outcome = outcome_name;
        },
        Search: function(){
            let url ="/sql/search";
            axios.post(url,{
                tour_name:this.select_tournament_name,
                team_name:this.select_team,
                outcome_name:this.select_outcome
            }).then((res) => {
                this.searchs=res.data;
               console.log(this.searchs);
                for(var i=0; i< this.searchs.length;i++){
                    this.latitudes = this.searchs[i].LAT;
                    this.longitudes = this.searchs[i].LNG;
                    this.search_teams = this.searchs[i].TE;
        
                    let location = { lat: Number(this.latitudes), lng: Number(this.longitudes)};
                    let marker = this.addMarker(String(this.search_teams), location);
                    this.markers.push(marker);
                    
                }
                for(var i=0; i< this.searchs.length;i++){
                    this.latitudes_ene = this.searchs[i].ELAT;
                    this.longitudes_ene = this.searchs[i].ELNG;
                    this.search_ene = this.searchs[i].ENE;
            
                    let location = { lat: Number(this.latitudes_ene), lng: Number(this.longitudes_ene)};
                    let marker = this.addMarker(String(this.search_ene), location);
                    this.markers.push(marker);
                    
                }

            })
        },
        addBlueMarkerMatch:function(search_TE){

            for(var i=0;i<this.searchs.length;i++){
                if(this.searchs[i].TE == search_TE ){
                    this.latitudes_blue = this.searchs[i].LAT;
                    this.longitudes_blue = this.searchs[i].LNG;
                    this.search_blue = this.searchs[i].TE;
                    let location = { lat: Number(this.latitudes_blue), lng: Number(this.longitudes_blue)};
                    let marker = this.addBlueMarker(String(this.search_blue), location);
                    this.markers.push(marker);

                    this.latitudes_blue_ene = this.searchs[i].ELAT;
                    this.longitudes_blue_ene = this.searchs[i].ELNG;
                    this.search_blue_ene = this.searchs[i].ENE;
                    let ene_location = { lat: Number(this.latitudes_blue_ene), lng: Number(this.longitudes_blue_ene)};
                    let ene_marker = this.addBlueMarker(String(this.search_blue_ene), ene_location);
                    this.markers.push(ene_marker);

                }else if(this.searchs[i].ENE == search_TE){
                    this.latitudes_blue_ene = this.searchs[i].ELAT;
                    this.longitudes_blue_ene = this.searchs[i].ELNG;
                    this.search_blue_ene = this.searchs[i].ENE;
                    let location = { lat: Number(this.latitudes_blue_ene), lng: Number(this.longitudes_blue_ene)};
                    let marker = this.addBlueMarker(String(this.search_blue_ene), location);
                    this.markers.push(marker);

                    this.latitudes_blue = this.searchs[i].LAT;
                    this.longitudes_blue = this.searchs[i].LNG;
                    this.search_blue = this.searchs[i].TE;
                    let team_location = { lat: Number(this.latitudes_blue), lng: Number(this.longitudes_blue)};
                    let team_marker = this.addBlueMarker(String(this.search_blue), team_location);
                    this.markers.push(team_marker);
                }
            }
           
        },
        updateTeam: function(tournament_name) {
            this.select_tournament_name = tournament_name;
            let url = "/sql/team";
          axios.post(url,{
            name:tournament_name
          }).then((res) => {
              this.teams=res.data;
          })
        },
        
        updateTeam_group:function(){
            console.log('Group');
            let url = "/sql/team_from_group";
            axios.post(url,{
                name:this.select_tournament_name
            }).then((res) => {
                this.teams=res.data;
                this.isDisplayGroup = "block";
            })
        },
        updateTeam_knock:function(){
            console.log('Knockout');
            let url = "/sql/team_from_knock";
            axios.post(url,{
                name:this.select_tournament_name
            }).then((res) => {
                this.teams=res.data;
            })
        },

        LoadOutcome:function(){
            let url ="/sql/outcome";
            axios.get(url).then((res) => {
                this.outcomes=res.data;
            })
        },

        LoadTour: function(){
            let url = "/sql/tournament";
            axios.get(url).then((res) => {
                this.tournaments=res.data;
            })
        },
        LoadGroup: function(){
           let url ="/sql/group";
            axios.get(url).then((res) => {
                this.groups=res.data;
              
            })
        },
        
        addMarker(title, location, callback) {
            let marker = new google.maps.Marker(
                {
                    position: location,
                    map: this.map,
                    title: title
                }
            );
            return marker;
        },
        addBlueMarker(title,location, callback){
            let marker = new google.maps.Marker(
                {
                    position: location,
                    map: this.map,
                    title: title,
                    icon:{
                        url:"https://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                        scaledSize: new google.maps.Size(40, 40) 
                    }
                }
            );
            return marker;  
        },
        clearMarkers: function () {
            this.markers.forEach((marker) => {
                marker.setMap(null);
            })
            this.markers = [];
        },
    }
});