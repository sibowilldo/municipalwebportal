/* istanbul ignore file */
import * as dom from './dom/index.js'
import { swalClasses } from '../utils/classes.js'

// Fix iOS scrolling http://stackoverflow.com/q/39626302

export const iOSfix = () => {
  const iOS = (/iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream) || (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1)
  if (iOS && !dom.hasClass(document.body, swalClasses.iosfix)) {
    const offset = document.body.scrollTop
    document.body.style.top = `${offset * -1}px`
    dom.addClass(document.body, swalClasses.iosfix)
    lockBodyScroll()
  }
}

const lockBodyScroll = () => { // #1246
  const container = dom.getContainer()
  let preventTouchMove
  container.ontouchstart = (e) => {
    preventTouchMove = shouldPreventTouchMove(e.target)
  }
  container.ontouchmove = (e) => {
    if (preventTouchMove) {
      e.preventDefault()
      e.stopPropagation()
    }
  }
}

const shouldPreventTouchMove = (target) => {
  const container = dom.getContainer()
  if (target === container) {
    return true
  }
  if (
    !dom.isScrollable(container) &&
    target.tagName !== 'INPUT' && // #1603
    !(
      dom.isScrollable(dom.getContent()) && // #1944
      dom.getContent().contains(target)
    )
  ) {
    return true
  }
  return false
}

export const undoIOSfix = () => {
  if (dom.hasClass(document.body, swalClasses.iosfix)) {
    const offset = parseInt(document.body.style.top, 10)
    dom.removeClass(document.body, swalClasses.iosfix)
    document.body.style.top = ''
    document.body.scrollTop = (offset * -1)
  }
}
