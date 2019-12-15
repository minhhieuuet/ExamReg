import BaseModelRequest from './BaseModelRequest';

export default class TestSiteRequest extends BaseModelRequest {
  getTestSites(params) {
    const url = '/admin/test-sites';
    return this.get(url, params);
  }

  store(params) {

    const url = '/admin/test-site';

    return this.post(url, params);
  }

  show(testSiteId) {
    const url = '/admin/test-site/' + testSiteId;
    return this.get(url);
  }

  update(testSiteId, params) {
    const url = '/admin/test-site/' + testSiteId;
    return this.put(url, params);
  }

  removeOneTestSite(testSiteId) {
    const url = '/admin/test-site/' + testSiteId;
    return this.del(url);
  }

  removeManyTestSites(testSiteIds) {
    const url = '/admin/many-test-sites';
    return this.del(url, {ids: testSiteIds});
  }

}
