const initialState = {
    visitors: [],
    compositions: []
};

const reducer = (state = initialState, action) => {
    switch(action.type) {
        case "ADD_VISITOR":
            state.visitors.push(action.data);
            return state;
        case "ADD_COMPOSITION":
            state.compositions.push(action.data);
            return state;
        default:
            return state;    
    }
}

export default reducer;