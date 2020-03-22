export default {
    state: {
        headerTitle: "Default"
    },
    
    mutations: {
        setHeaderTitle(state, title) {
            state.headerTitle = title;
        },
        asidePage() {
            $('#beWrapper').addClass('be-aside');
            $('#beContent').addClass('be-no-padding')
        }
    },

    actions: {
        // 
    }
}
