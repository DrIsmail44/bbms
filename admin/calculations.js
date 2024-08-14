let calculations = new Vue({
    el: '#calculations',
    data: {
            varietyTotal: 1,
            vtData: [],
            otherSelect: '',
            other: '',
            otherInput: '',
            materialName: '',
            allMaterials,
            category: '',
            selectedMaterials: {},
            materialsToDisplay: [],
            selections: {
                calculations: [],
                totalCost: 0,
                comments: '',
                others
            },
        showCommentBox: false
    },
    methods: {
        displayOptions(){
            // this.other = 'hrllo'
            document.getElementById('otherInput').style.display = 'none';
            document.getElementById('selectionBtn').style.display = 'none';
            document.getElementById('otherSelect').style.display = 'block';
            this.displayData()
        },  
        displayData() {
            this.formData = {
                vData: this.vtData,
                other: this.other,
                materialName: this.materialName
            }
        },
        updateSelection(i, key, val){
            if (key === 'costAndName') {
                let indx  = val[0].target.value
                let varieties = Object.values(val[1])[0]
                // update
                this.selections.calculations[i]['unitCost']=Number(varieties[indx].cost)
                this.selections.calculations[i]['name']=varieties[indx].name
            }else{
                this.selections.calculations[i][key]=Number(val.target.value)
            }
            return this.updateTotals(i)
        },
        updateTotals(i){
            // handle multiplication of qty and unit cost
            let selected = this.selections.calculations[i];
            if(selected.unitCost !== undefined && selected.qty !== undefined){
                this.selections.calculations[i]['total'] = selected.unitCost * selected.qty
            }
        },
        remove(i){
            // handle deleting from list
            this.selections.calculations.splice(i,1);
            this.materialsToDisplay.splice(i, 1)
        }
    },
    watch: {
        otherSelect(val) {
            if (val === "Other") {
                //when user selects 'other'
                this.other = null
                document.getElementById('otherInput').style.display = 'block';
                document.getElementById('selectionBtn').style.display = 'block';
                document.getElementById('otherSelect').style.display = 'none';
                this.displayData()
            }else{
                this.other = val
                this.displayData()

            }
            // console.log(val)
        },
        otherInput(val){
                this.other = val
                this.displayData()
        },
        selectedMaterials(val){
            this.materialsToDisplay.push(val);
            let data = {}; //instantiate an empty obj
            data['category'] = Object.keys(val)[0] // assign category to data.category
            data['total'] = 0 // instantiate total property
            this.selections.calculations.push(data);

        }

    },
    computed: {
        total: function(){
            let t = 0;
            for (let i = 0; i < this.selections.calculations.length; i++) {
                t += this.selections.calculations[i].total                
            }
            this.selections.totalCost = t
            return this.selections.totalCost
        }
    }
});

