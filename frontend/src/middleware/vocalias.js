export default function guest({ next, store }) {
    if ( !(store.getters.get_nro === 7 || store.getters.get_nro === 8 || store.getters.get_nro === 9 || store.getters.get_nro === 10 || store.getters.get_nro === 16 || store.getters.get_nro === 17 || store.getters.get_nro === 18 || store.getters.get_nro === 19) ) {
        return next({
            name: 'Home'
        })
    } else {
        next();
    }
}