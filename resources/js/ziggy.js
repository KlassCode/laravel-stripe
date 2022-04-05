const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"hello":{"uri":"\/","methods":["GET","HEAD"]},"success":{"uri":"success","methods":["GET","HEAD"]},"cancel":{"uri":"cancel","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
