const path = require('path')

module.exports = options => {

  let backend = 'http://localhost:8000';

  // each page has a backend path (should return full html page), and a js file to
  // run when it loads
  let pages = [
    // see https://vbuild.js.org/#/?id=proxy-api-request
    { name: 'home', path: '/', entry: 'src/home.js' },
    { name: 'otherPage', path: '/other-page', entry: 'src/other-page.js' },
  ];

  let entryConf = {
    client: [], // gets upset if you don't include this
  };

  let proxyConf = {
    '/api': backend + '/api',
  };

  pages.forEach(page => {
    proxyConf[page.path] = backend + page.path;
    if (options.dev) {
      entryConf[page.name] = [require.resolve('vbuild/lib/dev-client.es6'), page.entry];
    } else {
      entryConf[page.name] = [page.entry];
    }
  });

  return {
    entry: entryConf,
    filename: {
      // just output simple names, not magic hash ones as we define js paths in php backend
      js: '[name].js',
      css: '[name].css',
      static: '[name].[ext]'
    },
    postcss: [
      // add more postcss plugins here
      // by default we have autoprefixer pre added
    ],
    html: false,
    vendor: false, // not working properly yet... undefined webpackJsonp error in prod
    webpack(config) {
      require('fs').writeFileSync('/tmp/wp.json', JSON.stringify(config, null, 2));
      return config
    },
    proxy: proxyConf,
  };
};
