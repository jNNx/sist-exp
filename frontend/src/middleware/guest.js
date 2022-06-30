export default function guest({ next, store }) {
    if (store.getters.get_authenticated) {
        next("/")
    } else {
        next();
    }
}