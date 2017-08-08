import {BCSearch} from '../breathecode/module/search';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class search{
    
    constructor(){
        //any properties here using this.propertyName
    }
    
    init(){
        BCSearch.init('assets');
    }
}