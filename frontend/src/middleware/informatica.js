export default function guest({ next, store }) {
    if (!(store.getters.get_nro === 15 )) {
        return next({
            name: 'Home'
        })
    } else {
        next();
    }
}