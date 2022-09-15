export const ordinal = (date) => {
    const suffix = ["th", "st", "nd", "rd"];
    const delta = date%100;
    return (suffix[(delta-20)%10] || suffix[delta] || suffix[0]);
};

export const greeting = (name) => {
    const today = new Date()
    const curHr = today.getHours()

    if (curHr < 12) {
        return `Good morning, ${name}`;
    } else if (curHr < 18) {
        return `Good afternoon, ${name}`;
    } else {
        return `Good evening, ${name}`;
    }
}
