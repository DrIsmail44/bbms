var example1 = new Vue({
    el: '#variety',
    data: {
            varietyTotal: 1,
            vtData: [],
            otherSelect: '',
            other: '',
            otherInput: '',
            materialName: '',
            formData: {}
    },
    methods: {
        updateVarietyName(index, val) {
            if (this.vtData[index-1] === undefined) {
                this.vtData[index-1] = {name: val.target.value}
                this.displayData()
            }else{
                this.vtData[index-1].name = val.target.value
                this.displayData()
            }
        },
        updateVarietyCost(index, val) {
            if (this.vtData[index-1] === undefined) {
                this.vtData[index-1] = {cost: val.target.value}
                this.displayData()
            }else{
                this.vtData[index-1].cost = val.target.value
                this.displayData()
            }

        },
        displayOptions(){
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
        },
        otherInput(val){
                this.other = val
                this.displayData()
        },
        materialName(val){
            this.displayData()
        }
},
});

